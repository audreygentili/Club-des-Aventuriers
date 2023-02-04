let audio, plateau, ctxP, img1, img2, txt, btn, titre, next, obj;
let lives = 3;
let aventure = 8;
let mission = 1;

// fonction onload
onload = function() {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        console.log(this.readyState);
        console.log(this.status);
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
        }
    };
    xmlhttp.open("GET","./ajax/objets.php",true);
    xmlhttp.send();

    next = get("#next");
    if (next != null) {
        next.onclick = function() { console.log("Bouton cliqué"); if (mission < 6) { mission ++; } window.onload();};
    }

	audio = get("#audio");
    if (audio != null) {
        if (mission <=5) audio.src = "./assets/Aventure"+aventure+"/mission"+mission+".mp3";
        else audio.src = "./assets/Aventure"+aventure+"/epilogue.mp3";
        audio.onended = fPlay;
    }

    // Plateau de jeu permettant de compter les points
    plateau = get("#plateau");
    ctxP= plateau.getContext('2d'); 
    img2= new Image();
    img2.src = './assets/plateau.png';
    img2.onload = function() {
        plateau.height = img2.naturalHeight*2;
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
        if (lives == 3) { // si l'équipe a trois vies
            ctxP.beginPath();
            ctxP.arc(110,335,30,0,2*Math.PI);
            ctxP.fillStyle = '#ECDA2A';
            ctxP.fill();
            ctxP.stroke();
        }
        ctxP.beginPath();
        let ht = 485-mission*65;
        if (mission >= 5) {
            ht = 485-mission*65+10;
        }
        ctxP.arc(250,ht,10,0,2*Math.PI);
        ctxP.fillStyle = '#ECDA2A';
        ctxP.fill();
        ctxP.stroke();
    };

    let objets = get("#objets");

    objets.addEventListener("click", event => {
        event.target.style.border = "2px solid green";
    });
}

function get(sel) {
	return document.querySelector(sel);
}

function fPlay() {
    txt = get("#p1");
    if (mission <= 5) txt.innerHTML = "Mission "+mission+" : ";
    else txt.innerHTML = "Aventure terminée !";
}