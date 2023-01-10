let audio, table, ctxT, plateau, ctxP, img1, img2, txt, btn, titre, next, obj;
let lives = 3;
let aventure = 8;
let mission = 1;
//let objets = [1..100];

// fonction onload
onload = function() {
    next = get("#next");
    if (next != null) {
        next.onclick = function() { console.log("Bouton click"); mission ++; window.onload();};
    }

    titre = get("#aventureT");
    if (titre != null) {
        titre.innerHTML = "Aventure "+aventure;
    }
	audio = get("#audio");
    if (audio != null) {
        if (mission <=5) audio.src = "assets/Aventure"+aventure+"/mission"+mission+".mp3";
        else audio.src = "assets/Aventure"+aventure+"/epilogue.mp3";
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
        table.height = "250";
        table.width = "800";
        ctxT.drawImage(img1, 0, 0);
    };

    // plateau de jeu permettant de compter les points
    plateau = get("#plateau");
    ctxP= plateau.getContext('2d'); 
    img2= new Image();
    img2.src = 'assets/plateau.png';
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

    obj = document.getElementsByClassName('objets');
    console.log(obj);

    for (i = 0; i < obj.length; i++) {
        obj[i].onclick = function() {
            console.log(this.src);
            var img = new Image();
            img.src = this.src;
            ctxT.drawImage(img, 0, 0);
        };
    }

    var obj1 = get("#obj1");	
	var rdn = Math.floor(Math.random()*110);
	obj1.src = 'assets/objects/'+rdn+'.png';
}

function drawImg(){
	var x = get("#table");
	var context = x.getContext('2d');	
	var imgElement = get("#obj1");
	var imgObj = new Image();
	imgObj.src = imgElement.src;
	console.log(imgObj.src);

	var imgW = imgObj.width;
	var imgH = imgObj.height;
	var imgX = (context.canvas.width * .5) - (imgW * .5);
	var imgY = (context.canvas.height * .5) - (imgH * .5);

	imgObj.onload = function() {
		context.clearRect(imgX, imgY, imgW, imgH);	
		context.drawImage(imgObj, imgX, imgY, imgW, imgH);
	};
} 

function get(sel) {
	return document.querySelector(sel);
}

function fPlay() {
    txt = get("#p1");
    if (mission <= 5) txt.innerHTML = "Mission "+mission+" : ";
    else txt.innerHTML = "Aventure terminée !";
}