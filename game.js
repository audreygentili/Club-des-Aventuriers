let audio, table, ctxT, plateau, ctxP, img1, img2, txt, btn;
let lives = 3;
let mission = 4;

// fonction onload
onload = function () {
	audio = get("#audio");
    if (audio != null) {
        if (mission <=5) audio.src = "assets/Aventure1/mission"+mission+".mp3";
        else audio.src = "assets/Aventure1/epilogue.mp3";
        audio.onended = fPlay;
    }
    btn = get("#game");
    if (btn != null) {
        btn.onclick = function() { window.location.href = "game.html"; };
    }
    // table de jeu
    table = get("#table");
    ctxT = table.getContext('2d'); 
    img1 = new Image();
    img1.src = 'assets/table.jpg';
    img1.onload = function() {
        table.height = "500";
        table.width = "800";
        ctxT.drawImage(img1, 0, 0);
    };

    // plateau de jeu permettant de compter les points
    plateau = get("#plateau");
    ctxP= plateau.getContext('2d'); 
    img2= new Image();
    img2.src = 'assets/plateau.png';
    img2.onload = function() {
        plateau.height = img2.naturalHeight;
        plateau.width = img2.naturalWidth;
        ctxP.drawImage(img2, 0, 0);
        if (lives >= 1) { // si l'équipe a une vie ou plus
            ctxP.beginPath();
            ctxP.arc(45,185,30,0,2*Math.PI);
            ctxP.fillStyle = '#ECDA2A';
            ctxP.fill();
            ctxP.stroke();
        }
        if (lives >= 2) { // si l'équipe a deux vies ou plus
            ctxP.beginPath();
            ctxP.arc(55,270,30,0,2*Math.PI);
            ctxP.fillStyle = '#ECDA2A';
            ctxP.fill();
            ctxP.stroke();
        }
        if (lives = 3) { // si l'équipe a trois vies
            ctxP.beginPath();
            ctxP.arc(110,335,30,0,2*Math.PI);
            ctxP.fillStyle = '#ECDA2A';
            ctxP.fill();
            ctxP.stroke();
        }
        ctxP.beginPath();
        let ht = 485-mission*65;
        ctxP.arc(250,ht,15,0,2*Math.PI);
        ctxP.fillStyle = 'black';
        ctxP.fill();
        ctxP.stroke();
    };
}

function get(sel) {
	return document.querySelector(sel);
}

function fPlay() {
    txt = get("#p1");
	txt.innerHTML = "Mission "+mission+" : ";
}