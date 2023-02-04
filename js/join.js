let btn, error, code;

function get(sel) {
	return document.querySelector(sel);
}

onload = function () {
    btn = get("#lobby");  
    error = get("#error"); 

    btn.addEventListener("click", function() {
        console.log("bouton cliqué");
        code = get("#code").value;
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            console.log(this.readyState);
            console.log(this.status);
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                if (this.responseText == "ok") {
                    window.location.href="./lobby.php"; 
                } else {
                    error.innerHTML = "Code non valide.";
                }
            }
        };
        xmlhttp.open("GET","./ajax/joingame.php?code="+code,true);
        xmlhttp.send();
    });
}



