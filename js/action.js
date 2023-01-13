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
let base_speed = (2 * Math.PI) / FPS / 5;

let planets = [];

window.addEventListener("resize", updateSize, false);

window.onload = (e) => {
    let cookies = decodeURIComponent(document.cookie).split(";");
    let distance = 0;
    let speed = 0;
    let color = 0;
    cookies.forEach((c) => {
        if (c.includes("planet-distance")) {
            distance = c.split("=")[1];
        }
        if (c.includes("planet-speed")) {
            speed = parseInt(c.split("=")[1]);
        }
        if (c.includes("planet-color")) {
            color = c.split("=")[1];
        }
        if (distance != 0 && speed != 0 && color != 0) {
            let planet = newPlanet(distance * 100, speed, 10, color);
            planets.push(planet);
            distance = 0;
            speed = 0;
            color = 0;
        }
    });
};

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
        // calculate the relative distance, reference is the max canvas size
        x: (posRadius / MAX_CANVAS_SIZE) * square_size,
        y: 0,
        angle: 0,
        entityRadius: (entityRadius / MAX_CANVAS_SIZE) * square_size,
        posRadius: (posRadius / MAX_CANVAS_SIZE) * square_size,
        speed: (base_speed * speed * 100) / posRadius,
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
