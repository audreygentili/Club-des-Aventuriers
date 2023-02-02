let btn;

onload = function () {
    btn = get("#game");
    btn.onclick = function() { window.location.href = "game.php"; };
}

function get(sel) {
	return document.querySelector(sel);
}