let btn, nb, aventure;

function get(sel) {
	return document.querySelector(sel);
}

onload = function () {
    btn = get("#lobby");
    let code = Math.floor(Math.random() * 9999);
    console.log(code);  

    // Création de la partie : redirection vers le lobby et initialisation des paramètres
    btn.addEventListener("click", function() {
      console.log("bouton cliqué");
      nb = get("#nb").value;
      aventure = get("#aventure").value;
      console.log(nb);
      console.log(aventure);
      let xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
          console.log(this.readyState);
          console.log(this.status);
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
          window.location.href = "lobby.php";
        }
      };
      xmlhttp.open("GET","./ajax/creategame.php?code="+code+"&nb="+nb+"&aventure="+aventure,true);
      xmlhttp.send();
    });
}



