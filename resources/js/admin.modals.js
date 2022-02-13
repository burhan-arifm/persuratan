window.onload = function() {
    document.getElementById("logout").addEventListener("click", function() {
        modal.fire({
            icon: "warning",
            title: "Anda yakin ingin keluar?",
            showCancelButton: true,
            showCloseButton: true,
            buttonsStyling: false,
            customClass: {
                confirmButton: "btn btn-danger m-1",
                cancelButton: "btn btn-outline-primary m-1"
            },
            confirmButtonText: "Ya, keluar",
            cancelButtonText: "Batalkan",
            showLoaderOnConfirm: true,
            focusConfirm: false,
            focusCancel: false,
            preConfirm: () => {
                return fetch(route("logout"), {
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector(
                            'meta[name="csrf-token"]'
                        ).content
                    },
                    method: "POST"
                })
                    .then(response => {
                        console.log(response);
                        if (!/2[0-9]{2}/.test(response.status)) {
                            throw new Error(response.statusText);
                        }

                        if (response.redirected) {
                            window.location = response.url;
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
            }
        });
    });
};
