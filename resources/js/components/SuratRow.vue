<template>
    <fragment>
        <td>{{ index + 1 }}</td>
        <td>{{ surat.nomor_surat }}</td>
        <td>{{ surat.identitas }} - {{ surat.pemohon }}</td>
        <td>{{ surat.jenis_surat }}</td>
        <td>{{ waktu_readable }}</td>
        <td>
            <a
                :id="`cetak-${surat.id}`"
                title="Cetak Surat"
                :href="route('surat.cetak', { id: surat.id })"
                class="btn btn-sm btn-primary"
                :data-toggle="tooltip"
                :data-placement="top"
            >
                <em class="fas fa-print"></em>
            </a>
            <a
                :id="`sunting-${surat.id}`"
                title="Sunting Surat"
                :href="route('surat.sunting', { id: surat.id })"
                class="btn btn-sm btn-primary"
                data-toggle="tooltip"
                data-placement="top"
            >
                <em class="fas fa-edit"></em>
            </a>
            <a
                :id="`hapus-${surat.id}`"
                title="Hapus Surat"
                href="#"
                @click="hapusSurat(surat.id, csrf_token)"
                class="btn btn-sm btn-danger"
                data-toggle="tooltip"
                data-placement="top"
            >
                <em class="fas fa-trash"></em>
            </a>
        </td>
    </fragment>
</template>

<script>
import dayjs from "dayjs";
import "dayjs/locale/id";
import localizedFormat from "dayjs/plugin/localizedFormat";
import relativeTime from "dayjs/plugin/relativeTime";
import { Fragment } from "vue-fragment";

dayjs.locale("id");
dayjs.extend(localizedFormat);
dayjs.extend(relativeTime);

export default {
    components: {
        Fragment
    },
    props: {
        surat: Object,
        index: Number,
        csrf_token: String,
        type: String
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
    },
    computed: {
        waktu_readable() {
            if (this.type === "terbaru") {
                return dayjs(this.surat.waktu).fromNow();
            }

            return dayjs(this.surat.waktu).format("LLLL");
        }
    }
};
</script>
