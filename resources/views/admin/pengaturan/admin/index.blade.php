@extends('admin.base')

@section('title', "Pengaturan Admin Akun")

@section('main')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2 justify-content-between">
                    <div class="col-4">
                        <a class="btn btn-primary" href="{{ route('pengaturan.admin.formTambah') }}"><i
                                class="ph-user-plus-fill ph-lg align-middle"></i> Tambah Admin</a>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($admins) > 0)
                        @foreach ($admins as $admin)
                        <tr id="admin-{{ $admin->id }}">
                            <td class="text-right">{{ $loop->iteration }}</td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->nip }}</td>
                            <td>
                                <button id="reset_{{ $admin->id }}" title="Reset Kata Sandi"
                                    class="btn btn-sm btn-primary btn-icon" data-toggle="tooltip" data-placement="top">
                                    <i class="ph-xl ph-key-fill align-middle"></i>
                                </button>
                                <button id="hapus_{{ $admin->id }}" title="Hapus Admin"
                                    class="btn btn-sm btn-outline-danger btn-icon" data-toggle="tooltip"
                                    data-placement="top">
                                    <i class="ph-xl ph-trash-fill align-middle"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="4" class="text-center">Belum terdapat Admin tambahan.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--tabel surat-->
@endsection

@section('scripts')
<script>
    function resetPassword(id) {
        modal.fire({
                title: "Apakah Anda yakin?",
                text:
                    "Anda akan menyetel ulang kata sandi untuk akun Admin ini. Kata sandi baru akan diberikan .",
                icon: "warning",
                showCancelButton: true,
                showCloseButton: true,
                buttonsStyling: false,
                customClass: {
                    confirmButton: "btn btn-danger m-1",
                    cancelButton: "btn btn-outline-primary m-1"
                },
                confirmButtonText: "Reset kata sandi",
                cancelButtonText: "Urungkan",
                showLoaderOnConfirm: true,
                focusConfirm: false,
                preConfirm: () => {
                    return fetch(route("pengaturan.admin.reset", { id }), {
                            headers: {
                                "X-CSRF-TOKEN": document.head.querySelector('meta[name="csrf-token"]').content
                            },
                            method: "GET"
                        })
                        .then(response => {
                            if (response.status !== 200) {
                                throw new Error(response.statusText);
                            }

                            return response.json();
                        })
                        .catch(error => {
                            throw new Error(error);
                        });
                }
            })
                .then(result => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Berhasil!",
                            html: `Kata sandi berhasil direset. Mohon untuk mencatat kata sandi yang akan diberikan, karena hanya muncul sekali saja. Kata sandi: <strong>${result.value.password}</strong>`,
                            icon: "success",
                            buttonsStyling: false,
                            customClass: {
                                confirmButton: "btn btn-primary m-1"
                            },
                            confirmButtonText: "Tutup"
                        }).then(result => {
                            if (result.value) {
                                Swal.close();
                            }
                        });
                    }
                })
                .catch(error => {
                    modal.fire({
                        title: "Terjadi Kesalahan",
                        text: error.message,
                        icon: "error",
                        buttonsStyling: false,
                        customClass: {
                            confirmButton: "btn btn-primary m-1"
                        }
                    });
                });
    }
    function hapusAdmin(id) {
        modal.fire({
                title: "Apakah Anda yakin menghapus admin ini?",
                text:
                    "Admin yang telah dihapus tidak dapat dikembalikan kembali.",
                icon: "warning",
                showCancelButton: true,
                showCloseButton: true,
                buttonsStyling: false,
                customClass: {
                    confirmButton: "btn btn-danger m-1",
                    cancelButton: "btn btn-outline-primary m-1"
                },
                confirmButtonText: "Hapus admin",
                cancelButtonText: "Urungkan",
                showLoaderOnConfirm: true,
                focusConfirm: false,
                preConfirm: () => {
                    return fetch(route("pengaturan.admin.hapus", { id }), {
                            headers: {
                                "X-CSRF-TOKEN": document.head.querySelector('meta[name="csrf-token"]').content
                            },
                            method: "DELETE"
                        })
                        .then(response => {
                            if (response.status !== 200) {
                                throw new Error(response.statusText);
                            }

                            return response.data;
                        })
                        .catch(error => {
                            throw new Error(error);
                        });
                }
            })
                .then(result => {
                    if (result.isConfirmed) {
                        const row = document.getElementById(`admin-${id}`);
                        row.remove();
                        Swal.fire({
                            title: "Terhapus",
                            text: result.value.content,
                            icon: "success",
                            buttonsStyling: false,
                            customClass: {
                                confirmButton: "btn btn-primary m-1"
                            },
                            confirmButtonText: "Tutup"
                        }).then(result => {
                            if (result.value) {
                                Swal.close();
                            }
                        });
                    }
                })
                .catch(error => {
                    modal.fire({
                        title: "Terjadi Kesalahan",
                        text: error.message,
                        icon: "error",
                        buttonsStyling: false,
                        customClass: {
                            confirmButton: "btn btn-primary m-1"
                        }
                    });
                });
    }
    const resetPasswordButtons = document.querySelectorAll("button[id^=reset_]");
    const deleteAdminButtons = document.querySelectorAll("button[id^=hapus_]");
    for (let i = 0; i < resetPasswordButtons.length; i++) {
        resetPasswordButtons[i].addEventListener("click", function() {
            resetPassword(this.id.split("_")[1]);
        });
        deleteAdminButtons[i].addEventListener("click", function() {
            hapusAdmin(this.id.split("_")[1]);
        });
    }
</script>
@endsection
