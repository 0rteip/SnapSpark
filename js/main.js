$(document).ready(function () {
    let url = window.location;

    $('ul.navbar-nav a').filter(function () {
        return this.href == url;
    }).addClass('active').attr("aria-courrent", "page");
});

/**
 *  Notify the worker to send a message to the reciver
 *
 * @param {string} reciver
 * @param {string} type
 */
function notify(reciver, type) {
    worker.postMessage(reciver + '¬' + type);
}

const worker = new Worker('js/worker.js');
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
