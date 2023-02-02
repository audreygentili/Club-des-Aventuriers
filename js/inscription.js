let btn, mdp, mdp1;

onload = function () {
    btn = get("#submit");
    mdp = get("#mdp");
    mdp1 = get("#mdp1");
    btn.disabled = true;
    console.log(mdp.value);

    mdp.addEventListener('keyup', (evt) => {
        console.log(evt.target.value);
        if (evt.target.value != mdp1.value) btn.disabled = true;
        else btn.disabled = false;   
    });

    mdp1.addEventListener('keyup', (evt) => {
        console.log(evt.target.value);
        if (evt.target.value != mdp.value) btn.disabled = true;
        else btn.disabled = false;   
    });
}

function get(sel) {
	return document.querySelector(sel);
}