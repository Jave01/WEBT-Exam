window.onload = function () {
    let btn = document.getElementById("render-last");
    if (document.cookie.search("last_val_present") != -1) {
        let cookie_val = document.cookie
            .split("; ")
            .find((row) => row.startsWith("last_val_present"))
            .split("=")[1];

        if (cookie_val == "true") {
            btn.disabled = false;
        } else {
            btn.disabled = true;
        }
    } else {
        btn.disabled = true;
    }
};

function check_input(evt) {
    let target = evt.target;
    let id_num = target.id[target.id.length - 1];
    let value = parseInt(target.value);
    let el_name = "";
    let text = "";
    let hidden = false;
    let type = "";

    if (target.classList.contains("distance")) {
        el_name = "wrong-input-distance" + id_num;
        type = "Distance";
    } else if (target.classList.contains("speed")) {
        el_name = "wrong-input-speed" + id_num;
        type = "Speed";
    }
    if (target.value === "") {
        text = type + " value not valid";
    } else if (value < target.min) {
        text = type + " value too small";
    } else if (value > target.max) {
        text = type + " value too big";
    } else {
        hidden = true;
    }

    let inp_err_el = document.getElementById(el_name);
    inp_err_el.innerHTML = text;
    inp_err_el.hidden = hidden;
}
