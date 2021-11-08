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
} catch (e) {}
