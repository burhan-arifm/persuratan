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
                return axios
                    .post(route("logout"), {
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector(
                                'meta[name="csrf-token"]'
                            ).content
                        }
                    })
                    .then(response => {
                        if (response.status !== 204) {
                            console.log(response);
                            console.log(response.data);
                            throw new Error(response.statusText);
                        }

                        window.location.href = route("login");
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
