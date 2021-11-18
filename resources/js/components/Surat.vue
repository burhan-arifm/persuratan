<template>
    <div v-if="letters.length > 0">
        <div class="row mb-2">
            <div class="col-4 ml-2 input-group input-group-sm">
                <input
                    type="search"
                    name="filter-input"
                    id="filter-input"
                    class="form-control"
                    placeholder="Cari surat..."
                    v-model="filter"
                />
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
            <tbody v-if="filteredLetters.length > 0">
                <tr v-for="(surat, index) in sortedLetters" :key="surat.id">
                    <surat-row
                        :surat="surat"
                        :index="index"
                        :csrf_token="csrf_token"
                        :type="type"
                    ></surat-row>
                </tr>
            </tbody>
            <tbody v-else>
                <tr>
                    <td colspan="6" class="text-center">
                        <h6>Tidak ada surat yang ditemukan</h6>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div v-else>
        <h6 class="text-center">Belum ada pengajuan surat kemahasiswaan.</h6>
    </div>
</template>

<script>
import SuratRow from "./SuratRow.vue";
import { Howl } from "howler";

export default {
    props: ["current", "type"],
    components: {
        SuratRow
    },
    data() {
        return {
            letters: [],
            csrf_token: document.head.querySelector('meta[name="csrf-token"]')
                .content,
            timer: "",
            filter: "",
            first_loaded: false
        };
    },
    created() {
        this.fetchSurat();
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
            Echo.channel("persuratan").listen("SuratDiajukan", payload => {
                this.letters.push(payload.surat);
                if (this.type == "terbaru") {
                    this.playSound();
                }
            });
            Echo.channel("persuratan").listen("SuratDisunting", payload => {
                const surat = this.letters.find(
                    surat => surat.id === payload.surat.id
                );
                if (surat) {
                    this.letters.pop(surat);
                    this.letters.push(payload.surat);
                    if (this.type == "terbaru") {
                        this.playSound();
                    }
                } else {
                    this.letters.push(payload.surat);
                    if (this.type == "terbaru") {
                        this.playSound();
                    }
                }
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
                console.log(payload);
                const surat = this.letters.find(
                    surat => surat.id === payload.surat.id
                );
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
        }
    },
    computed: {
        filteredLetters() {
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
            });
        },
        sortedLetters() {
            return this.filteredLetters.sort(
                (a, b) => new Date(b.waktu) - new Date(a.waktu)
            );
        }
    },
    beforeDestroy() {
        clearInterval(this.timer);
    }
};
</script>
