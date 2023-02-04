let btn, code, nbJ, start;

function get(sel) {
	return document.querySelector(sel);
}

onload = function () {
    start = false;
    btn = get("#game");  
    code = get("#code").innerHTML;
    nbJ = get("#nbJ").innerHTML;

    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        console.log(this.readyState);
        console.log(this.status);
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            let response = parseInt(this.responseText);
            if (response == 100) {
                window.location.href = "./partie.php";
            } else if (response > nbJ) {
                window.location.reload();
            } else if (response >= nbJ) {
                setTimeout(function() {
                    onload();
                }, "5000");
            }
        }
    };
    xmlhttp.open("GET","./ajax/lobbygame.php?code="+code+"&start=no",true);
    xmlhttp.send();

    if (btn != null) {
        btn.addEventListener("click", function() {
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                console.log(this.readyState);
                console.log(this.status);
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    onload();
                }
            }; 
            xmlhttp.open("GET","./ajax/lobbygame.php?code="+code+"&start=yes",true);
            xmlhttp.send();
        });   
    }
}



