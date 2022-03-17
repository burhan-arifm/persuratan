@extends('admin.base')

@section('title', "Daftar Pengajuan Surat")

@section('main')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body" x-data="datatable()">
                <div class="row mb-2 justify-content-between">
                    <div class="col-4">
                        <input type="search" name="filter-input" id="filter-input" class="form-control"
                            placeholder="Cari surat..." x-model="filter" />
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary" @click="createReport()"><i
                                class="ph-microsoft-excel-logo-fill ph-lg align-middle"></i> Cetak laporan</button>
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
                                    <td class="pointer" @click="detailSurat(surat)" x-text="surat.pemohon">
                                    </td>
                                    <td class="pointer" @click="detailSurat(surat)" x-text="surat.jenis_surat">
                                    </td>
                                    <td class="pointer" @click="detailSurat(surat)" x-text="surat.waktu_readable"></td>
                                    <td>
                                        <a :id="`cetak-${surat.id}`" title="Cetak Surat"
                                            :href="route('surat.cetak', { id: surat.id })"
                                            class="btn btn-sm btn-primary btn-icon" data-toggle="tooltip"
                                            data-placement="top">
                                            <i class="ph-xl ph-printer-fill align-middle"></i>
                                        </a>
                                        <a :id="`sunting-${surat.id}`" title="Sunting Surat"
                                            :href="route('surat.sunting', { id: surat.id })"
                                            class="btn btn-sm btn-outline-primary btn-icon" data-toggle="tooltip"
                                            data-placement="top">
                                            <i class="ph-xl ph-note-pencil-fill align-middle"></i>
                                        </a>
                                        <a :id="`hapus-${surat.id}`" title="Hapus Surat" href="#"
                                            @click="hapusSurat(surat.id)" class="btn btn-sm btn-outline-danger btn-icon"
                                            data-toggle="tooltip" data-placement="top">
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
        </div>
    </div>
</div>
<!--tabel surat-->
@endsection



@section('scripts')
<script>
    Alpine.data("datatable", () => ({
        filter: "",
        letters: @json($letters).map(letter => ({ ...letter, waktu_readable: dayjs(letter.updated_at).format("dddd, DD MMMM YYYY HH:mm") })),
        csrf_token: document.head.querySelector('meta[name="csrf-token"]').content,
        get filteredLetters() {
            return this.letters.filter(letter => {
                const nomorSurat = letter.nomor_surat.toLowerCase();
                const tipeSurat = letter.jenis_surat.toLowerCase();
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
                (a, b) => new Date(b.updated_at) - new Date(a.updated_at)
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
                    modal.fire({
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
                    Swal.fire({
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
        createReport() {
            const workbook = XLSX.utils.book_new();

            const semuaSurat = this.letters.map(({nomor_surat, tanggal_terbit, pemohon, jenis_surat, status_surat, waktu_readable}, index) => ({no: index + 1, nomor_surat, tanggal_terbit, pemohon, jenis_surat, status_surat, waktu_readable}));
            const semuaSuratSheet = XLSX.utils.json_to_sheet(semuaSurat);
            XLSX.utils.book_append_sheet(workbook, semuaSuratSheet, "Semua surat");
            XLSX.utils.sheet_add_aoa(
                semuaSuratSheet,
                [
                    [
                        "No",
                        "Nomor Surat",
                        "Tanggal Terbit",
                        "Pemohon",
                        "Jenis Surat",
                        "Status Surat",
                        "Waktu Pengajuan",
                    ],
                ],
                { origin: "A1" }
            );
            semuaSuratSheet["!cols"] = [
                { wch: 5 },
                { wch: semuaSurat.reduce((w, r) => Math.max(w, r.nomor_surat.length), 10) },
                { wch: semuaSurat.reduce((w, r) => Math.max(w, r.tanggal_terbit.length), 10) },
                { wch: semuaSurat.reduce((w, r) => Math.max(w, r.pemohon.length), 10) },
                { wch: semuaSurat.reduce((w, r) => Math.max(w, r.jenis_surat.length), 10) },
                { wch: semuaSurat.reduce((w, r) => Math.max(w, r.status_surat.length), 10) },
                { wch: semuaSurat.reduce((w, r) => Math.max(w, r.waktu_readable.length), 10) },
            ];

            const izinKunjungan = this.letters
                .filter((data) => data.jenis_surat.toLowerCase().includes("izin kunjungan"))
                .map(
                    ({
                        nomor_surat,
                        tanggal_terbit,
                        pemohon,
                        izin_kunjungan,
                        waktu_readable,
                    }, index) => ({
                        no: index + 1,
                        nomor_surat,
                        tanggal_terbit,
                        pemohon,
                        program_studi: izin_kunjungan.jurusan.nama_program_studi,
                        instansi: izin_kunjungan.instansi_penerima,
                        alamat_instansi: `${izin_kunjungan.alamat_instansi}, ${izin_kunjungan.kota_instansi}`,
                        mata_kuliah: izin_kunjungan.mata_kuliah,
                        dosen_pengampu: izin_kunjungan.dosen_pengampu,
                        pelaksanaan_kunjungan: `${izin_kunjungan.tanggal_kunjungan} Pukul ${izin_kunjungan.waktu_readable_kunjungan}WIB`,
                        waktu_readable,
                    })
                );
            const izinKunjunganSheet = XLSX.utils.json_to_sheet(izinKunjungan);
            XLSX.utils.book_append_sheet(workbook, izinKunjunganSheet, "Izin Kunjungan");
            XLSX.utils.sheet_add_aoa(
                izinKunjunganSheet,
                [
                    [
                        "No",
                        "Nomor Surat",
                        "Tanggal Terbit",
                        "Pemohon",
                        "Program Studi",
                        "Instansi yang dikunjungi",
                        "Alamat Instansi",
                        "Mata Kuliah",
                        "Dosen Pengampu MK",
                        "Pelaksanaan Kunjungan",
                        "Waktu Pengajuan",
                    ],
                ],
                { origin: "A1" }
            );
            izinKunjunganSheet["!cols"] = [
                { wch: 5 },
                { wch: izinKunjungan.reduce((w, r) => Math.max(w, r.nomor_surat.length), 10) },
                { wch: izinKunjungan.reduce((w, r) => Math.max(w, r.tanggal_terbit.length), 10) },
                { wch: izinKunjungan.reduce((w, r) => Math.max(w, r.pemohon.length), 10) },
                { wch: izinKunjungan.reduce((w, r) => Math.max(w, r.program_studi.length), 10) },
                { wch: izinKunjungan.reduce((w, r) => Math.max(w, r.instansi.length), 10) },
                { wch: izinKunjungan.reduce((w, r) => Math.max(w, r.alamat_instansi.length), 10) },
                { wch: izinKunjungan.reduce((w, r) => Math.max(w, r.mata_kuliah.length), 10) },
                { wch: izinKunjungan.reduce((w, r) => Math.max(w, r.dosen_pengampu.length), 10) },
                { wch: izinKunjungan.reduce((w, r) => Math.max(w, r.pelaksanaan_kunjungan.length), 10) },
                { wch: izinKunjungan.reduce((w, r) => Math.max(w, r.waktu_readable.length), 10) },
            ];

            const izinObservasi = this.letters
                .filter((data) =>
                    data.jenis_surat.toLowerCase().includes("izin observasi")
                )
                .map(
                    ({
                        nomor_surat,
                        tanggal_terbit,
                        mahasiswa: {
                            nim,
                            nama,
                            jurusan: { nama_program_studi },
                        },
                        izin_observasi,
                        waktu_readable,
                    }, index) => ({
                        no: index + 1,
                        nomor_surat,
                        tanggal_terbit,
                        pemohon: `${nim} - ${nama}`,
                        nama_program_studi,
                        instansi: izin_observasi.lokasi_observasi,
                        alamat_instansi: `${izin_observasi.alamat_lokasi}, ${izin_observasi.kota_lokasi}`,
                        topik: izin_observasi.topik_skripsi,
                        waktu_readable,
                    })
                );
            const izinObservasiSheet = XLSX.utils.json_to_sheet(izinObservasi);
            XLSX.utils.book_append_sheet(workbook, izinObservasiSheet, "Izin Observasi");
            XLSX.utils.sheet_add_aoa(
                izinObservasiSheet,
                [
                    [
                        "No",
                        "Nomor Surat",
                        "Tanggal Terbit",
                        "Pemohon",
                        "Program Studi",
                        "Instansi Pelaksanaan Observasi",
                        "Alamat Instansi Pelaksanaan Observasi",
                        "Topik Penelitian",
                        "Waktu Pengajuan",
                    ],
                ],
                { origin: "A1" }
            );
            izinObservasiSheet["!cols"] = [
                { wch: 5 },
                { wch: izinObservasi.reduce((w, r) => Math.max(w, r.nomor_surat.length), 10) },
                { wch: izinObservasi.reduce((w, r) => Math.max(w, r.tanggal_terbit.length), 10) },
                { wch: izinObservasi.reduce((w, r) => Math.max(w, r.pemohon.length), 10) },
                { wch: izinObservasi.reduce((w, r) => Math.max(w, r.nama_program_studi.length), 10) },
                { wch: izinObservasi.reduce((w, r) => Math.max(w, r.instansi.length), 10) },
                { wch: izinObservasi.reduce((w, r) => Math.max(w, r.alamat_instansi.length), 10) },
                { wch: izinObservasi.reduce((w, r) => Math.max(w, r.topik.length), 10) },
                { wch: izinObservasi.reduce((w, r) => Math.max(w, r.waktu_readable.length), 10) },
            ];

            const izinPraktik = this.letters
                .filter((data) =>
                    data.jenis_surat.toLowerCase().includes("izin praktik")
                )
                .map(
                    ({
                        nomor_surat,
                        tanggal_terbit,
                        mahasiswa: {
                            nim,
                            nama,
                            jurusan: { nama_program_studi },
                        },
                        izin_praktik,
                        waktu_readable,
                    }, index) => ({
                        no: index + 1,
                        nomor_surat,
                        tanggal_terbit,
                        pemohon: `${nim} - ${nama}`,
                        nama_program_studi,
                        instansi: izin_praktik.instansi_penerima,
                        alamat_instansi: `${izin_praktik.alamat_instansi}, ${izin_praktik.kota_lokasi}`,
                        mata_kuliah: izin_praktik.mata_kuliah,
                        dosen_mk: izin_praktik.dosen_pengampu,
                        waktu_readable,
                    })
                );
            const izinPraktikSheet = XLSX.utils.json_to_sheet(izinPraktik);
            XLSX.utils.book_append_sheet(workbook, izinPraktikSheet, "Izin Praktik Mata Kuliah");
            XLSX.utils.sheet_add_aoa(
                izinPraktikSheet,
                [
                    [
                        "No",
                        "Nomor Surat",
                        "Tanggal Terbit",
                        "Pemohon",
                        "Program Studi",
                        "Instansi Pelaksanaan Praktik",
                        "Alamat Instansi Pelaksanaan Praktik",
                        "Mata Kuliah",
                        "Dosen Pengampu MK",
                        "Waktu Pengajuan",
                    ],
                ],
                { origin: "A1" }
            );
            izinPraktikSheet["!cols"] = [
                { wch: 5 },
                { wch: izinPraktik.reduce((w, r) => Math.max(w, r.nomor_surat.length), 10) },
                { wch: izinPraktik.reduce((w, r) => Math.max(w, r.tanggal_terbit.length), 10) },
                { wch: izinPraktik.reduce((w, r) => Math.max(w, r.pemohon.length), 10) },
                { wch: izinPraktik.reduce((w, r) => Math.max(w, r.nama_program_studi.length), 10) },
                { wch: izinPraktik.reduce((w, r) => Math.max(w, r.instansi.length), 10) },
                { wch: izinPraktik.reduce((w, r) => Math.max(w, r.alamat_instansi.length), 10) },
                { wch: izinPraktik.reduce((w, r) => Math.max(w, r.mata_kuliah.length), 10) },
                { wch: izinPraktik.reduce((w, r) => Math.max(w, r.dosen_mk.length), 10) },
                { wch: izinPraktik.reduce((w, r) => Math.max(w, r.waktu_readable.length), 10) },
            ];

            const izinRiset = this.letters
                .filter((data) => data.jenis_surat.toLowerCase().includes("izin riset"))
                .map(
                    ({
                        nomor_surat,
                        tanggal_terbit,
                        mahasiswa: {
                            nim,
                            nama,
                            jurusan: { nama_program_studi },
                        },
                        izin_riset,
                        waktu_readable,
                    }, index) => ({
                        no: index + 1,
                        nomor_surat,
                        tanggal_terbit,
                        pemohon: `${nim} - ${nama}`,
                        nama_program_studi,
                        instansi: izin_riset.lokasi_riset,
                        alamat_instansi: `${izin_riset.alamat_lokasi}, ${izin_riset.kota_lokasi}`,
                        judul_skripsi: izin_riset.judul_skripsi,
                        pembimbing_1: izin_riset.pembimbing_1,
                        pembimbing_2: izin_riset.pembimbing_2,
                        waktu_readable,
                    })
                );
            const izinRisetSheet = XLSX.utils.json_to_sheet(izinRiset);
            XLSX.utils.book_append_sheet(workbook, izinRisetSheet, "Izin Riset");
            XLSX.utils.sheet_add_aoa(
                izinRisetSheet,
                [
                    [
                        "No",
                        "Nomor Surat",
                        "Tanggal Terbit",
                        "Pemohon",
                        "Program Studi",
                        "Instansi Pelaksanaan Riset",
                        "Alamat Instansi Pelaksanaan Riset",
                        "Judul/Topik/Masalah",
                        "Dosen Pembimbing 1",
                        "Dosen Pembimbing 2",
                        "Waktu Pengajuan",
                    ],
                ],
                { origin: "A1" }
            );
            izinRisetSheet["!cols"] = [
                { wch: 5 },
                { wch: izinRiset.reduce((w, r) => Math.max(w, r.nomor_surat.length), 10) },
                { wch: izinRiset.reduce((w, r) => Math.max(w, r.tanggal_terbit.length), 10) },
                { wch: izinRiset.reduce((w, r) => Math.max(w, r.pemohon.length), 10) },
                { wch: izinRiset.reduce((w, r) => Math.max(w, r.nama_program_studi.length), 10) },
                { wch: izinRiset.reduce((w, r) => Math.max(w, r.instansi.length), 10) },
                { wch: izinRiset.reduce((w, r) => Math.max(w, r.alamat_instansi.length), 10) },
                { wch: izinRiset.reduce((w, r) => Math.max(w, r.judul_skripsi.length), 10) },
                { wch: izinRiset.reduce((w, r) => Math.max(w, r.pembimbing_1.length), 10) },
                { wch: izinRiset.reduce((w, r) => Math.max(w, r.pembimbing_2.length), 10) },
                { wch: izinRiset.reduce((w, r) => Math.max(w, r.waktu_readable.length), 10) },
            ];

            const jobTraining = this.letters
                .filter((data) =>
                    data.jenis_surat.toLowerCase().includes("job training")
                )
                .map(
                    ({
                        nomor_surat,
                        tanggal_terbit,
                        mahasiswa: {
                            nim,
                            nama,
                            jurusan: { nama_program_studi },
                        },
                        job_training,
                        waktu_readable,
                    }, index) => ({
                        no: index + 1,
                        nomor_surat,
                        tanggal_terbit,
                        pemohon: `${nim} - ${nama}`,
                        nama_program_studi,
                        instansi: job_training.instansi_penerima,
                        alamat_instansi: `${job_training.alamat_instansi}, ${job_training.kota_lokasi}`,
                        pembimbing: job_training.dosen_pembimbing,
                        waktu_readable,
                    })
                );
            const jobTrainingSheet = XLSX.utils.json_to_sheet(jobTraining);
            XLSX.utils.book_append_sheet(workbook, jobTrainingSheet, "Izin Job Training");
            XLSX.utils.sheet_add_aoa(
                jobTrainingSheet,
                [
                    [
                        "No",
                        "Nomor Surat",
                        "Tanggal Terbit",
                        "Pemohon",
                        "Program Studi",
                        "Instansi Pelaksanaan Job Training",
                        "Alamat Instansi Pelaksanaan Job Training",
                        "Dosen Pembimbing Job Training",
                        "Waktu Pengajuan",
                    ],
                ],
                { origin: "A1" }
            );
            jobTrainingSheet["!cols"] = [
                { wch: 5 },
                { wch: jobTraining.reduce((w, r) => Math.max(w, r.nomor_surat.length), 10) },
                { wch: jobTraining.reduce((w, r) => Math.max(w, r.tanggal_terbit.length), 10) },
                { wch: jobTraining.reduce((w, r) => Math.max(w, r.pemohon.length), 10) },
                { wch: jobTraining.reduce((w, r) => Math.max(w, r.nama_program_studi.length), 10) },
                { wch: jobTraining.reduce((w, r) => Math.max(w, r.instansi.length), 10) },
                { wch: jobTraining.reduce((w, r) => Math.max(w, r.alamat_instansi.length), 10) },
                { wch: jobTraining.reduce((w, r) => Math.max(w, r.pembimbing.length), 10) },
                { wch: jobTraining.reduce((w, r) => Math.max(w, r.waktu_readable.length), 10) },
            ];

            const izinPPM = this.letters
                .filter((data) => data.jenis_surat.toLowerCase().includes("ppm"))
                .map(
                    ({
                        nomor_surat,
                        tanggal_terbit,
                        mahasiswa: {
                            nim,
                            nama,
                            jurusan: { nama_program_studi },
                        },
                        ppm,
                        waktu_readable,
                    }, index) => ({
                        no: index + 1,
                        nomor_surat,
                        tanggal_terbit,
                        pemohon: `${nim} - ${nama}`,
                        nama_program_studi,
                        lokasi_ppm: ppm.instansi_penerima,
                        alamat_lokasi_ppm: `${ppm.alamat_instansi}, ${ppm.kota_lokasi}`,
                        pembimbing: ppm.dosen_pembimbing,
                        waktu_readable,
                    })
                );
            const izinPPMSheet = XLSX.utils.json_to_sheet(izinPPM);
            XLSX.utils.book_append_sheet(workbook, izinPPMSheet, "Izin PPM");
            XLSX.utils.sheet_add_aoa(
                izinPPMSheet,
                [
                    [
                        "No",
                        "Nomor Surat",
                        "Tanggal Terbit",
                        "Pemohon",
                        "Program Studi",
                        "Lokasi Pelaksanaan PPM",
                        "Alamat Lokasi Pelaksanaan PPM",
                        "Dosen Pembimbing PPM",
                        "Waktu Pengajuan",
                    ],
                ],
                { origin: "A1" }
            );
            izinPPMSheet["!cols"] = [
                { wch: 5 },
                { wch: izinPPM.reduce((w, r) => Math.max(w, r.nomor_surat.length), 10) },
                { wch: izinPPM.reduce((w, r) => Math.max(w, r.tanggal_terbit.length), 10) },
                { wch: izinPPM.reduce((w, r) => Math.max(w, r.pemohon.length), 10) },
                { wch: izinPPM.reduce((w, r) => Math.max(w, r.nama_program_studi.length), 10) },
                { wch: izinPPM.reduce((w, r) => Math.max(w, r.lokasi_ppm.length), 10) },
                { wch: izinPPM.reduce((w, r) => Math.max(w, r.alamat_lokasi_ppm.length), 10) },
                { wch: izinPPM.reduce((w, r) => Math.max(w, r.pembimbing.length), 10) },
                { wch: izinPPM.reduce((w, r) => Math.max(w, r.waktu_readable.length), 10) },
            ];

            XLSX.writeFile(workbook, "data-surat.xlsx");
        },
        init() {
            Echo.channel("persuratan").listen("surat-diajukan", payload => {
                this.letters.push(payload.surat);
            });
            Echo.channel("persuratan").listen("surat-disunting", payload => {
                const suratBaru = payload.surat;
                const surat = this.letters.find(
                    surat => surat.id === payload.surat.id
                );
                if (surat) {
                    this.letters.pop(surat);
                    this.letters.push(suratBaru);
                } else {
                    this.letters.push(suratBaru);
                }
            });
            Echo.channel("persuratan").listen("surat-diproses", payload => {
                const surat = this.letters.find(
                    surat => surat.id === payload.surat.id
                );
                if (surat) {
                    this.letters.pop(surat);
                }
            });
            Echo.channel("persuratan").listen("surat-dihapus", payload => {
                console.log(payload);
                const surat = this.letters.find(
                    surat => surat.id === payload.surat.id
                );
                if (surat) {
                    this.letters.pop(surat);
                }
            });
        }
    }));
    Alpine.start();
</script>
@endsection
