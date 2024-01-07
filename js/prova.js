console.log("prova.js loaded");

function clickBt(bt) {
    document.getElementById('info').innerHTML = "<ul> <?php foreach($templateParams[" + bt.getAttribute('id') + "] as $info) : ?> <li><p><?php echo $info['info'] ?></p></li><?php endforeach;?> </ul>";
} 

const bts = document.querySelectorAll('input');
bts.forEach(bt => {
    console.log(bt.getAttribute('id'));
    bt.addEventListener("click", clickBt(bt));
});
console.log(document.getElementById('info'))