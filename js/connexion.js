let btn, mdp;

onload = function () {
    btn = get("#submit");
    mdp = get("#mdp");
    btn.disabled = true;

    mdp.addEventListener('keyup', (evt) => {
        if (evt.target.value == "") btn.disabled = true;
        else btn.disabled = false;   
    });
}

function get(sel) {
	return document.querySelector(sel);
}