let audio, plateau, ctxP, img1, img2, txt, btn, titre, next;
let aventure;
let mission;
let vies;
let objets;
let objV = []; // Objets adaptés choisis par le conteur
let objR = []; // Objets non adaptés
let objG = []; // Objets choisis par l'autre joueur
let e;

function get(sel) {
	return document.querySelector(sel);
}

onload = function() {
    // Récupération des paramètres de la partie
    let xml = new XMLHttpRequest();
    xml.onreadystatechange = function() {
        console.log(this.readyState);
        console.log(this.status);
        if (this.readyState == 4 && this.status == 200) {
            let doc = this.responseXML;
            console.log(doc);
            if (doc != null) {
                let param = doc.getElementsByTagName("Param");
                aventure = param[0].getElementsByTagName("Aventure")[0].childNodes[0].nodeValue;
                mission = param[0].getElementsByTagName("Mission")[0].childNodes[0].nodeValue;
                vies = param[0].getElementsByTagName("Vies")[0].childNodes[0].nodeValue;
                console.log(aventure);
                console.log(mission);
                console.log(vies);
                aventure = parseInt(aventure);
                mission = parseInt(mission);
                vies = parseInt(vies);
                console.log(typeof(mission), mission)
                initPlateau();
                setAudio();
                play();
            }
        }
    };
    xml.open("GET","./ajax/params.php",true);
    xml.send();
}

function play() {
    if (mission < 6) {
        // Récupération de l'étape du chapitre
        e = parseInt(get("#etape").innerHTML);
        console.log(e);

        if (e == 0) {
            // Initialisation des objets pour le conteur
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let doc = this.responseXML;
                    if (doc != null) {
                        ajoutObjets(doc);
                        setInterval(etape2, 1500);
                    } else {
                        setInterval(etape1, 1500);
                    }
                }
            };
            xmlhttp.open("GET","./ajax/ajoutobjets.php",true);
            xmlhttp.send();
        }

        // Etape de choix du 2e joueur, affichage des objets choisis par le conteur
        if (e == 1) {
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let doc = this.responseXML;
                    if (doc != null) {
                        ajoutObjets(doc);
                        setInterval(etape1, 1500);
                    } else {
                        setInterval(etape2, 1500);
                    }
                }
            };
            xmlhttp.open("GET","./ajax/recupobjets.php",true);
            xmlhttp.send();
        }

        // Etape de résolution de la mission
        if (e == 2) {
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let rep = this.responseText;
                    if (rep == "gagne") {
                        setInterval(etape1, 1500);
                        get("#rep").innerHTML = "Bravo ! Vous avez trouvé les objets adaptés pour réussir la mission !";
                    } else if (rep == "perdu") {
                        setInterval(etape1, 1500);
                        get("#rep").innerHTML = "Dommage, vous n'avez pas trouvé les objets adaptés pour réussir la mission... <br/>Vous pouvez tout de même passer à la mission suivante !";
                    } else if (rep == "gagne1") {
                        get("#rep").innerHTML = "Bravo ! Vous avez trouvé les objets adaptés pour réussir la mission !";
                    } else if (rep == "perdu1") {
                        get("#rep").innerHTML = "Dommage, vous n'avez pas trouvé les objets adaptés pour réussir la mission... <br/>Vous pouvez tout de même passer à la mission suivante !";
                    }
                }
            };
            xmlhttp.open("GET","./ajax/resolution.php",true);
            xmlhttp.send();
        }
    }

    // Bouton de validation des choix du conteur
    next = get("#valider");
    if (next != null) {
        next.onclick = function() {
            validation();
        };
    }

    // Bouton de validation des choix de l'autre joueur
    nextC = get("#validerChoix");
    if (nextC != null) {
        nextC.onclick = function() {
            validationChoix();
        };
    }

    // Bouton pour passer à la mission suivante
    nextM = get("#missionSuivante");
    if (nextM != null) {
        nextM.onclick = function() {
            etape1();
        };
    }
}

// Ajout des objets sur le plateau
function ajoutObjets(doc) {
    let objets = [];
    let obj = doc.getElementsByTagName("Objet");
    for (let i = 0; i < obj.length; i++) {
        objets.push(obj[i].getElementsByTagName("Nom")[0].childNodes[0].nodeValue);
    }
    objets.sort();
    let div = get("#objets");
    if (div != null) {
        for (let i = 0; i < objets.length; i++) {
            let obj = document.createElement("img");
            obj.setAttribute("src", "assets/objects/"+objets[i]+".png");
            div.appendChild(obj);
            obj.addEventListener("click", function() {
                console.log(this);
                select(this, objets[i]);
            });
        }
    }
}

function validation() {
    if (objV.length == 2 && objR.length == 3) {
        // Stockage des objets choisis dans la base de données
        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function() {
            console.log(this.readyState);
            console.log(this.status);
            if (this.readyState == 4 && this.status == 200) {
            }
        };
        xml.open("GET","./ajax/choixobjets.php?obj1="+objV[0]+"&obj2="+objV[1]+"&obj3="+objR[0]+"&obj4="+objR[1]+"&obj5="+objR[2],true);
        xml.send();

        // Passage à l'étape de choix des objets par l'autre joueur
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            console.log(this.readyState);
            console.log(this.status);
            if (this.readyState == 4 && this.status == 200) {
                let etape = this.responseText;
                console.log(etape);
                window.location.reload();
            }
        };
        xmlhttp.open("GET","./ajax/etape1.php",true);
        xmlhttp.send();
    } else {
        let consigne = get("#consigne");
        consigne.innerHTML = "Vous devez sélectionner <b>2 objets adaptés</b> (verts) et <b>3 objets inadaptés</b> (rouges)"
    }
}

function etape1() {
    console.log("etape 1 appelée");
    // Passage à l'étape de choix des objets
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        console.log(this.readyState);
        console.log(this.status);
        if (this.readyState == 4 && this.status == 200) {
            let etape = this.responseText;
            console.log("etape : ", etape);
            if (etape != "ok") {
                window.location.reload();
            }
        }
    };
    xmlhttp.open("GET","./ajax/etape1.php",true);
    xmlhttp.send();
}

function validationChoix() {
    if (objG.length == 2) {
        // Comparaison des objets choisis avec les objets du conteur
        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function() {
            console.log(this.readyState);
            console.log(this.status);
            if (this.readyState == 4 && this.status == 200) {
            }
        };
        xml.open("GET","./ajax/choixobjets2.php?obj1="+objG[0]+"&obj2="+objG[1],true);
        xml.send();

        // Passage à l'étape de résolution de la mission pour l'autre joueur
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            console.log(this.readyState);
            console.log(this.status);
            if (this.readyState == 4 && this.status == 200) {
                let etape = this.responseText;
                console.log(etape);
                window.location.reload();
            }
        };
        xmlhttp.open("GET","./ajax/etape2.php",true);
        xmlhttp.send();
    } else {
        let consigne = get("#consigne");
        consigne.innerHTML = "Vous devez sélectionner <b>2 objets</b>";
    }
}

function etape2() {
    // Passage à l'étape de résolution de la mission pour le conteur
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        console.log(this.readyState);
        console.log(this.status);
        if (this.readyState == 4 && this.status == 200) {
            let etape = this.responseText;
            console.log(etape);
            if (etape != "ok") {
                window.location.reload();
            }
        }
    };
    xmlhttp.open("GET","./ajax/etape2.php",true);
    xmlhttp.send();
}

// Modification de la couleur de l'objet lors de la sélection
function select(obj, num) {
    if (e == 0) {
        if (obj.style.backgroundColor == "") {
            obj.style.backgroundColor = "rgb(182, 215, 168)";
            objV.push(num);
        } else if (obj.style.backgroundColor == "rgb(182, 215, 168)") {
            obj.style.backgroundColor = "rgb(232, 112, 112)";
            var index = objV.indexOf(num);
            if (index !== -1) {
                objV.splice(index, 1);
            }
            objR.push(num);
        } else if (obj.style.backgroundColor == "rgb(232, 112, 112)") {
            obj.style.backgroundColor = "";
            var index = objR.indexOf(num);
            if (index !== -1) {
                objR.splice(index, 1);
            }
        }
        console.log(objV);
        console.log(objR);
    } else {
        if (obj.style.backgroundColor == "") {
            obj.style.backgroundColor = "rgb(188, 188, 188)";
            objG.push(num);
        } else if (obj.style.backgroundColor == "rgb(188, 188, 188)") {
            obj.style.backgroundColor = "";
            var index = objG.indexOf(num);
            if (index !== -1) {
                objG.splice(index, 1);
            }
        }
        console.log(objG);
    }
}

// Audio du chapitre en cours
function setAudio() {
    audio = get("#audio");
    if (audio != null) {
        if (mission <=5) audio.src = "./assets/Aventure"+aventure+"/mission"+mission+".mp3";
        else audio.src = "./assets/Aventure"+aventure+"/epilogue.mp3";
        audio.onended = fPlay; 
    }
}

// Affichage de la mission
function fPlay() {
    txt = get("#p1");
    if (mission <= 5) {
        if (aventure == 1) {
            if (mission == 1) {
                txt.innerHTML = "Mission 1 : Comment égayez-vous l'uniforme du colonel ?";
            } else if (mission == 2) {
                txt.innerHTML = "Mission 2 : Comment faites-vous pour que la vache quitte les voies ?";
            } else if (mission == 3) {
                txt.innerHTML = "Mission 3 : Comment divertissez-vous les passagers ?";
            } else if (mission == 4) {
                txt.innerHTML = "Mission 4 : Comment faites-vous pour que Billy Cliff ne vous voie pas ?";
            } else if (mission == 5) {
                txt.innerHTML = "Mission 5 : Comment arrêtez-vous la locomotive ?";
            }
        } else if (aventure == 8) {
            if (mission == 1) {
                txt.innerHTML = "Mission 1 : Quels objets utilisez-vous pour construire les \"toilettes du futur\" ?";
            } else if (mission == 2) {
                txt.innerHTML = "Mission 2 : Comment faites-vous sortir l'espion des fourrés ?";
            } else if (mission == 3) {
                txt.innerHTML = "Mission 3 : Comment faites-vous pour que vos vélos roulent plus vite que d'habitude ?";
            } else if (mission == 4) {
                txt.innerHTML = "Mission 4 : Comment vous débarrassez-vous du robot tueur ?";
            } else if (mission == 5) {
                txt.innerHTML = "Mission 5 : Avez quels objets construisez-vous les toilettes les plus inutiles possible ?";
            }
        }
    } else txt.innerHTML = "Aventure terminée !";
}

// Plateau de jeu permettant de compter les points
function initPlateau() {
    plateau = get("#plateau");
    ctxP= plateau.getContext('2d'); 
    img2= new Image();
    img2.src = './assets/plateau.png';
    img2.onload = function() {
        plateau.height = img2.naturalHeight*2;
        plateau.width = img2.naturalWidth;
        ctxP.drawImage(img2, 0, 0);
        if (vies >= 1) { // si l'équipe a une vie ou plus
            ctxP.beginPath();
            ctxP.arc(45,185,30,0,2*Math.PI);
            ctxP.fillStyle = '#ECDA2A';
            ctxP.fill();
            ctxP.stroke();
        }
        if (vies >= 2) { // si l'équipe a deux vies ou plus
            ctxP.beginPath();
            ctxP.arc(55,270,30,0,2*Math.PI);
            ctxP.fillStyle = '#ECDA2A';
            ctxP.fill();
            ctxP.stroke();
        }
        if (vies == 3) { // si l'équipe a trois vies
            ctxP.beginPath();
            ctxP.arc(110,335,30,0,2*Math.PI);
            ctxP.fillStyle = '#ECDA2A';
            ctxP.fill();
            ctxP.stroke();
        }
        // affichage du pion sur la mission en cours
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
}