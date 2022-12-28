let audio, table, ctxT, plateau, ctxP, img1, img2, txt, btn;
let lives = 3;

onload = function () {
	audio = get("#audio1");
    if (audio != null) {
        audio.onplay = fPlay;
    }
    btn = get("#game");
    if (btn != null) {
        btn.onclick = function() { window.location.href = "game.html"; };
    }
    table = get("#table");
    ctxT = table.getContext('2d'); 
    img1 = new Image();
    img1.src = 'assets/table.jpg';
    img1.onload = function() {
        table.height = "500";
        table.width = "800";
        ctxT.drawImage(img1, 0, 0);
    };
    plateau = get("#plateau");
    ctxP= plateau.getContext('2d'); 
    img2= new Image();
    img2.src = 'assets/plateau.png';
    img2.onload = function() {
        plateau.height = img2.naturalHeight;
        plateau.width = img2.naturalWidth;
        ctxP.drawImage(img2, 0, 0);
        if (lives >= 1) {
            ctxP.beginPath();
            ctxP.arc(45,185,30,0,2*Math.PI);
            ctxP.fillStyle = '#ECDA2A';
            ctxP.fill();
            ctxP.stroke();
        }
        if (lives >= 2) {
            ctxP.beginPath();
            ctxP.arc(55,270,30,0,2*Math.PI);
            ctxP.fillStyle = '#ECDA2A';
            ctxP.fill();
            ctxP.stroke();
        }
        if (lives >= 3) {
            ctxP.beginPath();
            ctxP.arc(110,335,30,0,2*Math.PI);
            ctxP.fillStyle = '#ECDA2A';
            ctxP.fill();
            ctxP.stroke();
        }
    };
}

function get(sel) {
	return document.querySelector(sel);
}

function fPlay() {
    txt = get("#p1");
	txt.innerHTML = "Mission 1";
}