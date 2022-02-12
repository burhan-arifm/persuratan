@extends('admin.base')

@section('title', "Beranda")

@section('main')
    <div class="row">
        <div class="col-md-12" x-data="datatable()">
            <section class="row">
                <div class="col-md-3 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Surat belum diproses</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800" x-text="letters.length"></div>
                                </div>
                                <div class="col-auto">
                                    <i class="ph-envelope-fill ph-3x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="row">
                <div class="col-md-12">
                    <section class="card">
                        <template x-if="letters.length > 0">
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-4 ml-2 input-group input-group-sm">
                                        <input type="search" name="filter-input" id="filter-input" class="form-control"
                                            placeholder="Cari surat..." x-model="filter" />
                                    </div>
                                </div>
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nomor Surat</th>
                                            <th>Pemohon</th>
                                            <th>Jenis Surat</th>
                                            <th>Waktu Pengajuan</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <template x-if="filteredLetters.length > 0">
                                        <tbody>
                                            <template x-for="(surat, index) in sortedLetters" :key="surat.id">
                                                <tr>
                                                    <td class="pointer text-right" @click="detailSurat(surat)" x-text="index + 1"></td>
                                                    <td class="pointer" @click="detailSurat(surat)" x-text="surat.nomor_surat"></td>
                                                    <td class="pointer" @click="detailSurat(surat)"
                                                        x-text="`${surat.identitas} - ${surat.pemohon}`">
                                                    </td>
                                                    <td class="pointer" @click="detailSurat(surat)" x-text="surat.jenis_surat"></td>
                                                    <td class="pointer" @click="detailSurat(surat)" x-text="surat.waktu_readable"></td>
                                                    <td>
                                                        <a :id="`cetak-${surat.id}`" title="Cetak Surat" :href="route('surat.cetak', { id: surat.id })"
                                                            class="btn btn-sm btn-primary btn-icon" data-toggle="tooltip"
                                                            data-placement="top">
                                                            <i class="ph-xl ph-printer-fill align-middle"></i>
                                                        </a>
                                                        <a :id="`sunting-${surat.id}`" title="Sunting Surat" :href="route('surat.sunting', { id: surat.id })"
                                                            class="btn btn-sm btn-outline-primary btn-icon" data-toggle="tooltip"
                                                            data-placement="top">
                                                            <i class="ph-xl ph-note-pencil-fill align-middle"></i>
                                                        </a>
                                                        <a :id="`hapus-${surat.id}`" title="Hapus Surat" href="#" @click="hapusSurat(surat.id)"
                                                            class="btn btn-sm btn-outline-danger btn-icon" data-toggle="tooltip"
                                                            data-placement="top">
                                                            <i class="ph-xl ph-trash-fill align-middle"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </template>
                                    <template x-if="!(filteredLetters.length > 0)">
                                        <tbody>
                                            <tr>
                                                <td colspan="6" class="text-center">
                                                    <h6>Tidak menemukan surat yang dimaksud. Apakah benar kata kuncinya?</h6>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </template>
                                </table>
                            </div>
                        </template>
                        <template x-if="!(letters.length > 0)">
                            <div class="card-body">
                                <h6 class="text-center">Belum ada pengajuan surat kemahasiswaan terbaru.</h6>
                            </div>
                        </template>
                    </section>
                </div>
            </section>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    const sound = new Howl({
        src: "storage/bell.mp3",
        autoplay: true,
        volume: 0.5
    });

    Alpine.data("datatable", () => ({
        filter: "",
        letters: [],
        csrf_token: document.head.querySelector('meta[name="csrf-token"]').content,
        async fetchLetters() {
            fetch("http://127.0.0.1:8000/api/data-surat/terbaru")
                .then(response => response.json())
                .then(data => {
                    this.letters = data.map(letter => ({ ...letter, waktu_readable: dayjs(letter.waktu).fromNow() }));
                })
        },
        get filteredLetters() {
            return this.letters.filter(letter => {
                const nomorSurat = letter.nomor_surat.toLowerCase();
                const tipeSurat = letter.jenis_surat.toLowerCase();
                const identitas = letter.identitas.toString();
                const pemohon = letter.pemohon.toLowerCase();
                const filter = this.filter.toLowerCase();

                return (
                    nomorSurat.includes(filter) ||
                    tipeSurat.includes(filter) ||
                    identitas.includes(filter) ||
                    pemohon.includes(filter)
                );
            })
        },
        get sortedLetters() {
            return this.filteredLetters.sort(
                (a, b) => new Date(b.waktu) - new Date(a.waktu)
            );
        },
        detailSurat(surat) {
            Swal.fire({
                title: `Detail Surat ${surat.jenis_surat}`,
                text: "Memuat surat...",
                showCloseButton: true,
                showLoaderOnConfirm: true,
                didOpen: () => {
                    Swal.clickConfirm();
                },
                preConfirm: () => {
                    return fetch(route("surat.detail", { id: surat.id }), {
                            headers: {
                                "X-CSRF-TOKEN": this.csrf_token
                            }
                        })
                        .then(response => {
                            if (response.status !== 200) {
                                throw new Error(response.statusText);
                            }

                            return response.text();
                        })
                        .catch(error => {
                            throw new Error(error);
                        });
                }
            })
                .then(result => {
                    console.log(result)
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: `Detail Surat ${surat.jenis_surat}`,
                            width: "80%",
                            html: result.value.replace(
                                /[\s\S]+(<style>)/,
                                `$1`
                            ),
                            showCloseButton: true,
                            showDenyButton: true,
                            showCancelButton: true,
                            focusConfirm: false,
                            buttonsStyling: false,
                            customClass: {
                                confirmButton: "btn btn-primary m-1",
                                denyButton: "btn btn-outline-primary m-1",
                                cancelButton: "btn btn-outline-danger m-1"
                            },
                            confirmButtonText: `<i class="ph-printer-fill ph-lg align-middle"></i> Cetak Surat`,
                            confirmButtonAriaLabel: "Cetak Surat",
                            denyButtonText: `<i class="ph-note-pencil-fill ph-lg align-middle"></i> Sunting Surat`,
                            denyButtonAriaLabel: "Sunting Surat",
                            cancelButtonText: `<i class="ph-trash-fill ph-lg align-middle"></i> Hapus Surat`,
                            cancelButtonAriaLabel: "Hapus Surat"
                        }).then(result => {
                            if (result.isConfirmed) {
                                window.location.href = route("surat.cetak", {
                                    id: this.surat.id
                                });
                            } else if (result.isDenied) {
                                window.location.href = route("surat.sunting", {
                                    id: this.surat.id
                                });
                            } else if (
                                result.isDismissed &&
                                result.dismiss === Swal.DismissReason.cancel
                            ) {
                                this.hapusSurat();
                            }
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: "Terjadi Kesalahan",
                        text: error.message,
                        buttonsStyling: false,
                        customClass: {
                            confirmButton: "btn btn-primary m-1"
                        },
                        icon: "error"
                    });
                });
        },
        hapusSurat(idSurat) {
            modal.fire({
                title: "Apakah Anda yakin?",
                text:
                    "Surat yang telah dihapus tidak dapat dikembalikan kembali.",
                icon: "warning",
                showCancelButton: true,
                showCloseButton: true,
                buttonsStyling: false,
                customClass: {
                    confirmButton: "btn btn-danger m-1",
                    cancelButton: "btn btn-outline-primary m-1"
                },
                confirmButtonText: "Ya, hapus surat tersebut",
                cancelButtonText: "Urungkan",
                showLoaderOnConfirm: true,
                focusConfirm: false,
                preConfirm: () => {
                    return  fetch(route("surat.hapus", { id: idSurat }), {
                            headers: {
                                "X-CSRF-TOKEN": this.csrf_token
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
                        Swal.fire({
                            title: "Terhapus",
                            text: "Surat yang Anda pilih berhasil dihapus.",
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
        },
        init() {
            Echo.channel("persuratan").listen("SuratDiajukan", payload => {
                this.letters.push({ ...payload.surat, waktu_readable: dayjs(payload.surat.waktu).fromNow() });
                sound.play();
            });
            Echo.channel("persuratan").listen("SuratDisunting", payload => {
                const suratBaru = { ...payload.surat, waktu_readable: dayjs(payload.surat.waktu).fromNow() }
                const surat = this.letters.find(
                    surat => surat.id === payload.surat.id
                );

                if (surat) {
                    this.letters.pop(surat);
                }

                this.letters.push(suratBaru);
                sound.play();
            });
            Echo.channel("persuratan").listen("SuratDiproses", payload => {
                const surat = this.letters.find(
                    surat => surat.id === payload.surat.id
                );
                if (surat) {
                    this.letters.pop(surat);
                }
            });
            Echo.channel("persuratan").listen("SuratDihapus", payload => {
                const surat = this.letters.find(
                    surat => surat.id === payload.surat.id
                );
                if (surat) {
                    this.letters.pop(surat);
                }
            });
            this.fetchLetters();
        }
    }));
    Alpine.start();
</script>
@endsection
