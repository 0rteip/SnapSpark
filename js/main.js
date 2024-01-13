console.log("main.js loaded");

$(document).ready(function () {
    let url = window.location;

    $('ul.navbar-nav a').filter(function() {
        return this.href == url;
    }).addClass('active').attr("aria-courrent", "page");
});
