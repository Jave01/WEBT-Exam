<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link
            rel="stylesheet"
            href="https://www.w3schools.com/w3css/4/w3.css"
        />
        <script src="https://cdn.jsdelivr.net/npm/vue@3"></script>

        <title>Galaxy Calculations</title>
    </head>
    <body class="w3-black w3-center">
        <nav class="w3-bar">
            <div class="bar-item-container">
                <a
                    href="./index.html"
                    class="bar-item w3-bar-item w3-button w3-mobile"
                    >HOME</a
                >
                <a
                    href="./index.html#information"
                    class="bar-item w3-bar-item w3-button w3-mobile"
                    >INFORMATION</a
                >
                <a
                    href="./index.html#input-form"
                    class="bar-item w3-bar-item w3-button w3-mobile"
                    >CALCULATOR</a
                >
            </div>
        </nav>
        <h1 class="">Your galaxy</h1>
        <main class="w3-content" id="main">
            <h2>General data</h2>
            <section id="dataSection1" class="w3-row-padding">
                <div class="w3-col s6 m6 l6">
                    <p>Time</p>
                    <p class="w3-large">3h</p>
                </div>
                <div class="w3-col s6 m6 l6">
                    <p>Another time</p>
                    <p class="w3-large">5h</p>
                </div>
            </section>
            <section class="w3-row-padding">
                <div class="w3-col s6 m6 l6">
                    <p>Time</p>
                    <p class="w3-large">3h</p>
                </div>
                <div class="w3-col s6 m6 l6">
                    <p>Another time</p>
                    <p class="w3-large">5h</p>
                </div>
            </section>
        </main>
        <canvas width="900" height="900" id="solarSystemCanvas"></canvas>
        <br />
        <input
            v-model="range"
            type="range"
            class=""
            min="1"
            max="100"
            value="50"
        />
        <p>Range: {{ range }}</p>
        <footer class="w3-text-color-grey w3-padding-16 w3-center">
            <p>Created by David Jäggli</p>
            <p>
                Code on
                <a
                    href="https://github.com/Jave01/WEBT-Exam"
                    class="w3-hover-text-blue"
                    target="_blank"
                    >Github</a
                >
            </p>
        </footer>
        <script></script>
        <script src="js/script.js"></script>
    </body>
</html>
