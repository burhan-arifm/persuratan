<template>
    <fragment>
        <td class="pointer text-right" @click="detailSurat()">
            {{ index + 1 }}
        </td>
        <td class="pointer" @click="detailSurat()">{{ surat.nomor_surat }}</td>
        <td class="pointer" @click="detailSurat()">
            {{ surat.identitas }} - {{ surat.pemohon }}
        </td>
        <td class="pointer" @click="detailSurat()">{{ surat.jenis_surat }}</td>
        <td class="pointer" @click="detailSurat()">{{ waktu_readable }}</td>
        <td>
            <a
                :id="`cetak-${surat.id}`"
                title="Cetak Surat"
                :href="route('surat.cetak', { id: surat.id })"
                class="btn btn-sm btn-primary btn-icon"
                data-toggle="tooltip"
                data-placement="top"
            >
                <i class="ph-xl ph-printer-fill align-middle"></i>
            </a>
            <a
                :id="`sunting-${surat.id}`"
                title="Sunting Surat"
                :href="route('surat.sunting', { id: surat.id })"
                class="btn btn-sm btn-outline-primary btn-icon"
                data-toggle="tooltip"
                data-placement="top"
            >
                <i class="ph-xl ph-note-pencil-fill align-middle"></i>
            </a>
            <a
                :id="`hapus-${surat.id}`"
                title="Hapus Surat"
                href="#"
                @click="hapusSurat()"
                class="btn btn-sm btn-outline-danger btn-icon"
                data-toggle="tooltip"
                data-placement="top"
            >
                <i class="ph-xl ph-trash-fill align-middle"></i>
            </a>
        </td>
    </fragment>
</template>

<style lang="scss" scoped>
.pointer {
    cursor: pointer;
}

.table td:last-child {
    padding: 0.5rem;
}
</style>

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
    mounted: function() {
        $("[data-toggle='tooltip']").tooltip();
    },
    methods: {
        detailSurat() {
            Swal.fire({
                title: `Detail Surat ${this.surat.jenis_surat}`,
                text: "Memuat surat...",
                showCloseButton: true,
                showLoaderOnConfirm: true,
                didOpen: () => {
                    Swal.clickConfirm();
                },
                preConfirm: () => {
                    return axios
                        .get(route("surat.detail", { id: this.surat.id }), {
                            headers: {
                                "X-CSRF-TOKEN": this.csrf_token
                            }
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
                            title: `Detail Surat ${this.surat.jenis_surat}`,
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
        hapusSurat() {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text:
                    "Surat yang telah dihapus tidak dapat dikembalikan kembali.",
                icon: "warning",
                showCancelButton: true,
                showCloseButton: true,
                reverseButtons: true,
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
                    return axios
                        .delete(route("surat.hapus", { id: this.surat.id }), {
                            headers: {
                                "X-CSRF-TOKEN": this.csrf_token
                            }
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
        }
    },
    computed: {
        waktu_readable() {
            if (this.type === "terbaru") {
                return dayjs(this.surat.waktu).fromNow();
            }

            return dayjs(this.surat.waktu).format("dddd, DD MMMM YYYY HH:mm");
        }
    }
};
</script>
