let app = Vue.createApp({
    d: 50,
    data() {
        return { range: 25 };
    },
}).mount("body");

const FPS = 60; // frames per second
const FPS_TIMEOUT = 1000 / FPS;
const MAX_CANVAS_SIZE = 900;

let canvas = document.getElementById("solarSystemCanvas");
let context = canvas.getContext("2d");
let square_size = MAX_CANVAS_SIZE;
let base_speed = (2 * Math.PI) / FPS;

let planet1 = newPlanet(100, 1, 10, "blue");
let planet2 = newPlanet(200, 5, 5, "red");
let planet3 = newPlanet(300, 2, 25, "green");
const planets = [planet1, planet2, planet3];

window.addEventListener("resize", updateSize, false);

function updateSize() {
    // update the canvas size to adjust to new/changin screen sizes
    let width = window.innerWidth;
    let height = window.innerHeight;

    // create square with the smaller value
    square_size = width > height ? height : width;
    canvas.width = square_size;
    canvas.height = square_size;
}

function animate() {
    // Time for next frame
    setTimeout(animate, FPS_TIMEOUT);

    // Update planet canvas frame
    update();

    // clear the canvs
    context.clearRect(0, 0, square_size, square_size);

    // draw the planets on their new positions
    draw();
}

function update() {
    for (let i = 0; i < planets.length; i++) {
        planets[i].update();
    }
}

function draw(c) {
    // c.beginPath();
    // c.fillStyle = "Black";
    // c.font = "bold 50pt Arial ";
    // c.fillText("Planets", position[0], position[1]);

    // draw sun
    context.fillStyle = "yellow";
    context.beginPath();
    context.arc(
        square_size / 2,
        square_size / 2,
        square_size / 75,
        0,
        2 * Math.PI
    );
    context.fill();

    // draw planets
    for (let i = 0; i < planets.length; i++) {
        context.fillStyle = planets[i].color;
        context.beginPath();
        context.arc(
            square_size / 2 + planets[i].x,
            square_size / 2 + planets[i].y,
            planets[i].entityRadius,
            0,
            2 * Math.PI
        );
        context.fill();
    }
}

function newPlanet(posRadius, speed, entityRadius, color) {
    let planet = {
        // calculate the relative distance, reference is the max canvas size (900)
        x: (posRadius / MAX_CANVAS_SIZE) * square_size,
        y: 0,
        angle: 0,
        entityRadius: (entityRadius / MAX_CANVAS_SIZE) * square_size,
        posRadius: (posRadius / MAX_CANVAS_SIZE) * square_size,
        speed: base_speed / speed,
        color: color,
        update() {
            let user_input_speed = document.getElementById("speed").value / 20;
            this.posRadius = (posRadius / MAX_CANVAS_SIZE) * square_size;
            this.x = Math.cos(this.angle) * this.posRadius;
            this.y = Math.sin(this.angle) * this.posRadius;
            this.angle += (this.speed * user_input_speed) % (2 * Math.PI);
            this.entityRadius = (entityRadius / MAX_CANVAS_SIZE) * square_size;
        },
    };
    return planet;
}

animate();
