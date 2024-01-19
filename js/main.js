$(document).ready(function () {
    let url = window.location;

    $('ul.navbar-nav a').filter(function () {
        return this.href == url;
    }).addClass('active').attr("aria-courrent", "page");
});

const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
