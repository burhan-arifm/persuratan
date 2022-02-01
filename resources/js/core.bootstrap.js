/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require("popper.js").default;
    window.$ = window.jQuery = require("jquery");
    window.Swal = require("sweetalert2");

    require("bootstrap");
    require("./jquery-easing");

    window.modal = Swal.mixin({
        reverseButtons: true
    });
    window.toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true
    });

    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
} catch (e) {}
