console.log("prova.js loaded");

function change(id) {
    document.querySelectorAll('section').forEach(
        section => {
            if (section.getAttribute('class') !== id) {
                section.style.display = 'none';
            } else {
                section.style.display = '';
            }
        }
    );
}

const bts = document.querySelectorAll('input');
bts.forEach(bt => {
    console.log(bt.getAttribute('id'));
    bt.addEventListener("click", function() {
        id =bt.getAttribute('id');
        change(id);
        console.log("click");
    });
})