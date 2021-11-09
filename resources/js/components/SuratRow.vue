<template>
    <fragment>
        <td>{{ index + 1 }}</td>
        <td>{{ surat.nomor_surat }}</td>
        <td>{{ surat.identitas }} - {{ surat.pemohon }}</td>
        <td>{{ surat.jenis_surat }}</td>
        <td>{{ surat.waktu_readable }}</td>
        <td>
            <a
                id="cetak-{{surat.id}}"
                title="Cetak Surat"
                :href="route('surat.cetak', { id: surat.id })"
                class="btn btn-sm btn-primary"
                @mouseover="showContent1 = true"
                @mouseleave="showContent1 = false"
            >
                <em class="fas fa-print"></em>
                <span v-show="showContent1">Cetak Surat</span>
            </a>
            <a
                id="sunting-{{surat.id}}"
                title="Sunting Surat"
                :href="route('surat.sunting', { id: surat.id })"
                class="btn btn-sm btn-primary"
                @mouseover="showContent2 = true"
                @mouseleave="showContent2 = false"
            >
                <em class="fas fa-edit"></em>
                <span v-show="showContent2">Sunting Surat</span>
            </a>
            <a
                id="hapus-{{surat.id}}"
                title="Hapus Surat"
                href="#"
                @click="hapusSurat(surat.id, csrf_token)"
                class="btn btn-sm btn-danger"
                @mouseover="showContent3 = true"
                @mouseleave="showContent3 = false"
            >
                <em class="fas fa-trash"></em>
                <span v-show="showContent3">Hapus Surat</span>
            </a>
        </td>
    </fragment>
</template>

<script>
import { Fragment } from "vue-fragment";

export default {
    components: {
        Fragment
    },
    props: {
        surat: Object,
        index: Number,
        csrf_token: String
    },
    data() {
        return {
            showContent1: false,
            showContent2: false,
            showContent3: false
        };
    },
    methods: {
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
                    fetch(this.route("surat.hapus", { id: id_surat }), {
                        method: "DELETE",
                        headers: {
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-TOKEN": token
                        }
                    })
                        .then(response => {
                            if (response.status === 200) {
                                Swal.fire({
                                    title: "Terhapus",
                                    text:
                                        "Surat yang Anda pilih berhasil dihapus.",
                                    type: "success"
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                title: "Gagal",
                                text: `Surat yang Anda pilih gagal dihapus. Alasan: ${error}`,
                                type: "error"
                            });
                        });
                }
            });
        }
    }
};
</script>
