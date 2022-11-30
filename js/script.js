let timeUntilNextFrame = 1; // 50 Bilder pro Sekunde

let position_start = [
    [-100, 400],
    [400, -100],
]; // x, y
let direction = 0;
let direction_max = [1900, 1000];
let position = position_start[0];

function animate() {
    // Setzte Timer für das nächste Bild
    setTimeout(animate, timeUntilNextFrame);

    let canvas = document.getElementById("canvas");
    let c = canvas.getContext("2d");

    // Positionen der Bildelemente anpassen
    update();

    c.clearRect(
        position_start[direction][0] - 100,
        position_start[direction][1] - 100,
        500,
        1000
    );

    // Bild zeichnen
    draw(c);
}
// Die Position ist global gespeichert:
// Jeder Event startet einen neuen Funktionsaufruf und beendet den aktuellen.
// Die Position kann also nicht im Scope der Funktion gespeichert werden.

function update() {
    position[direction] += 10;
    // Bewegung nach links

    // Zurücksetzten bei Verlassen des Canvas
    if (position[direction] > direction_max[direction]) {
        console.debug(direction);
        direction ^= 1;
        console.debug(direction);
        position[0] = position_start[direction][0];
        position[1] = position_start[direction][1];
    }
}

function draw(c) {
    c.beginPath();
    c.fillStyle = "Black";
    c.font = "bold 50pt Arial ";
    c.fillText("Animation", position[0], position[1]);
}

animate();