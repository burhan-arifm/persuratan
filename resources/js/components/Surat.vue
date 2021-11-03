<template>
    <table
    id="datatable"
        v-if="letters.length > 0"
        class="table table-bordered table-striped table-hover header-fixed"
    >
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
        <tbody>
            <tr v-for="(surat, index) in sortedLetters" :key="surat.id">
                <td>{{ ++index }}</td>
                <td>{{ surat.nomor_surat }}</td>
                <td>{{ surat.identitas }} - {{ surat.pemohon }}</td>
                <td>{{ surat.jenis_surat }}</td>
                <td>{{ surat.waktu_readable }}</td>
                <td>
                    <a
                        id="cetak"
                        title="Cetak Surat"
                        :href="route('surat.cetak', { id: surat.id })"
                        class="btn btn-sm btn-primary"
                        ><em class="fas fa-print"></em
                    ></a>
                    <a
                        id="sunting"
                        title="Sunting Surat"
                        :href="route('surat.sunting', { id: surat.id })"
                        class="btn btn-sm btn-primary"
                        ><em class="fas fa-edit"></em
                    ></a>
                    <a
                        id="hapus"
                        title="Hapus Surat"
                        href="#"
                        @click="hapusSurat(surat.id, csrf_token)"
                        class="btn btn-sm btn-danger"
                        ><em class="fas fa-trash"> </em
                    ></a>
                </td>
            </tr>
        </tbody>
    </table>
    <div v-else>
        <h6 class="text-center">Belum ada pengajuan surat kemahasiswaan.</h6>
    </div>
</template>

<script>
require("howler");

export default {
    props: ["current", "type"],
    data() {
        return {
            letters: [],
            csrf_token: document.head.querySelector('meta[name="csrf-token"]')
                .content,
            timer: "",
            first_loaded: false
        };
    },
    created() {
        this.fetchSurat();
        $("#datatable").DataTable({
            data: sortedLetters,
            "order": [[4, "desc"]]
        })
        this.listenForChanges();
        if (this.type == "terbaru") {
            this.timer = setInterval(this.fetchSurat, 60000);
        }
    },
    methods: {
        fetchSurat() {
            axios
                .get(this.route("data_surat." + this.type))
                .then(response => {
                    this.letters = response.data;
                    if (
                        this.type == "terbaru" &&
                        this.letters.length > 0 &&
                        !this.first_loaded
                    ) {
                        this.playSound();
                        this.first_loaded = !this.first_loaded;
                    }
                })
                .catch(error =>
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        timer: 3000,
                        type: "error",
                        title: error.message,
                        showConfirmButton: false
                    })
                );
        },
        listenForChanges() {
            Echo.channel("persuratan").listen("SuratDiajukan", e => {
                this.letters.push(e.surat);
                if (this.type == "terbaru") {
                    this.playSound();
                }
            });
            Echo.channel("persuratan").listen("SuratDisunting", e => {
                var surat = this.letters.find(surat => surat.id === e.surat.id);
                if (surat) {
                    this.letters.pop(surat);
                    this.letters.push(e.surat);
                    if (this.type == "terbaru") {
                        this.playSound();
                    }
                } else {
                    this.letters.push(e.surat);
                    if (this.type == "terbaru") {
                        this.playSound();
                    }
                }
            });
            Echo.channel("persuratan").listen("SuratDiproses", e => {
                var surat = this.letters.find(surat => surat.id === e.surat.id);
                if (surat) {
                    this.letters.pop(surat);
                }
            });
            Echo.channel("persuratan").listen("SuratDihapus", e => {
                var surat = this.letters.find(surat => surat.id === e.surat.id);
                if (surat) {
                    this.letters.pop(surat);
                }
            });
        },
        playSound() {
            var sound = new Howl({
                src: "storage/bell.mp3",
                volume: 5
            });
            sound.play();
        },
        hapusSurat(id_surat, token) {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text:
                    "Surat yang telah dihapus tidak dapat dikembalikan kembali.",
                type: "warning",
                showCancelButton: true,
                showCloseButton: true,
                confirmButtonText: "Ya, hapus surat tersebut",
                cancelButtonText: "Urungkan"
            }).then(result => {
                if (result.value) {
                    axios
                        .delete({
                            url: this.route("surat.hapus", { id: id_surat })
                            // data: { _method: "delete", _token: token }
                        })
                        .done(() => {
                            Swal.fire({
                                title: "Terhapus",
                                text: "Surat yang Anda pilih berhasil dihapus.",
                                type: "success"
                            });
                        })
                        .fail(error => {
                            Swal.fire({
                                title: "Gagal",
                                text: `Surat yang Anda pilih gagal dihapus. Alasan: ${error}`,
                                type: "error"
                            });
                        });
                }
            });
        }
    },
    computed: {
        sortedLetters: function() {
            return this.letters.sort(
                (a, b) => new Date(b.waktu) - new Date(a.waktu)
            );
        }
    },
    beforeDestroy() {
        clearInterval(this.timer);
    }
};
</script>
