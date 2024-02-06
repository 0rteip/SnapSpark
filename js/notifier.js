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
