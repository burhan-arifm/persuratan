(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/form"],{

/***/ "./resources/js/form-masking.js":
/*!**************************************!*\
  !*** ./resources/js/form-masking.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  $('#nip_orang_tua').mask('000000000000000000');
  $('#waktu_kunjungan').mask('00:00');
  $('#no_telepon').mask('000000000000');
  $('#semester').mask('SSSS');
  $('#nim').mask('0000000000');
});

/***/ }),

/***/ "./resources/js/form.js":
/*!******************************!*\
  !*** ./resources/js/form.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! ./form-masking */ "./resources/js/form-masking.js");

__webpack_require__(/*! ./select */ "./resources/js/select.js");

/***/ }),

/***/ "./resources/js/select.js":
/*!********************************!*\
  !*** ./resources/js/select.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  $(".selector").select2({
    theme: "bootstrap4"
  });
});

/***/ }),

/***/ 2:
/*!************************************!*\
  !*** multi ./resources/js/form.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\apps\20200601_E-Office_FIDKOM-UINSGD\02-Code_Implementation\server\persuratan-l7\resources\js\form.js */"./resources/js/form.js");


/***/ })

},[[2,"/js/manifest"]]]);