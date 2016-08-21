window.$ = window.jQuery = require('jquery');
require('bootsrtap-sass');
$( document ).ready(function () {
	console.log($.fn.tooltip.Constructor.VERSION);
})