window.onload = function() {
    document.getElementById("logout").addEventListener("click", function() {
        modal
            .fire({
                icon: "warning",
                title: "Ready to Leave?",
                text:
                    'Select "Logout" below if you are ready to end your current session.',
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "No"
            })
            .then(result => {
                if (result.value) {
                    fetch(route("logout"), {
                        method: "POST",
                        headers: {
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-TOKEN": document.head
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute("content")
                        }
                    }).then(response => {
                        window.location.href = response.url;
                    });
                }
            });
    });
};
