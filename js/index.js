function updateRenderLastButton() {
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
}

updateRenderLastButton();
