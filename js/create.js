let btn, code;

onload = function () {
    btn = get("#game");
    code = get("#code");
    let rnd = Math.floor(Math.random() * 9999);
    console.log(rnd);
    code.innerHTML = rnd;
    btn.onclick = function() { window.location.href = "game.php"; };
}

function get(sel) {
	return document.querySelector(sel);
}