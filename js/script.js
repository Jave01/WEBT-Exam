let app = Vue.createApp({
    d: 50,
    data() {
        return { range: 50 };
    },
}).mount("body");

console.log(app);

const fps = 60; // frames per second
const fpsTimeout = 1000 / fps;

let canvas = document.getElementById("solarSystemCanvas");
let context = canvas.getContext("2d");
let square_size = 900;
let base_speed = (2 * Math.PI) / fps;

let planet1 = newPlanet(100, 1, 10, "blue");
let planet2 = newPlanet(200, 5, 5, "red");
let planet3 = newPlanet(300, 2, 25, "green");
const planets = [planet1, planet2, planet3];

window.addEventListener("resize", updateSize, false);

function updateSize() {
    let width = window.innerWidth;
    let height = window.innerHeight;

    // create square with the smaller value
    square_size = width > height ? height : width;
    canvas.width = square_size;
    canvas.height = square_size;
}

function animate() {
    // Time for next frame
    setTimeout(animate, fpsTimeout);

    // Update planet positions
    update();

    context.clearRect(0, 0, square_size, square_size);

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
        // calculate the relative distance, reference is the max canvas size (700)
        x: (posRadius / 900) * square_size,
        y: 0,
        angle: 0,
        entityRadius: entityRadius,
        posRadius: (posRadius / 700) * square_size,
        speed: base_speed / speed,
        color: color,
        update() {
            this.posRadius = (posRadius / 700) * square_size;
            this.x = Math.cos(this.angle) * this.posRadius;
            this.y = Math.sin(this.angle) * this.posRadius;
            this.angle += this.speed % (2 * Math.PI);
        },
    };
    return planet;
}

animate();
