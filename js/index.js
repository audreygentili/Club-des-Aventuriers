let btn1, btn2;

onload = function () {
    btn1 = get("#create");
    btn2 = get("#join");
    btn1.onclick = function() { window.location.href = "create.php"; };
    btn2.onclick = function() { window.location.href = "join.php"; };
}

function get(sel) {
	return document.querySelector(sel);
}