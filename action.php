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
        <h1 class="">Your Solarsystem</h1>
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
            id="speed"
            min="-40"
            max="40"
        />
        <p>Speed: {{ range/20 }}x</p>
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
        <?php
        // setcookie(
        //     "testcookie",
        //     "new value"
        // );

        // constants
        const MAX_PLANETS = 4;
        const ATTR_COUNT = 4;

        const MIN_DISTANCE = 1;
        const MAX_DISTANCE = 10;
        const MIN_SPEED = 1;
        const MAX_SPEED = 10;
        const MIN_SIZE = 5;
        const MAX_SIZE = 10;

        
        function updateValues(){
            // update the calculated values
        }

        function updateCookies(){
            
        }

        // get all planet attributes
        $planet_attr = [];
        foreach($_GET as $key => $val){
            echo("<p>". $key . " ". $val . "</p>");
            if(str_contains($key, "planet-") && is_numeric($_GET[$key])){
                $planet_attr[$key] = intval($val);
            }
        }
        // Debug
        // foreach($planet_attr as $key => $val){
        //     echo ($key . ": " . $val . '<br>');
        // }
        echo ("<br>". count($planet_attr) . "<br>");
        $planet_count = (count($planet_attr) / ATTR_COUNT > MAX_PLANETS) ? MAX_PLANETS : count($planet_attr);

        if(isset($_COOKIE['last_val_present'])){
            // echo("<p>". $_GET . "</p>");
        } else if ($planet_count > 0){
            setcookie("last_val_present", "true");
            $_COOKIE['last_val_present'] = "true";
        } else {
            setcookie("last_val_present", "false");
            $_COOKIE['last_val_present'] = "false";
        }

        updateValues();


        // adjust planet attributes if they are not within valid range
        // for ($i=1; $i <= $planet_count; $i+1) { 
        //     $attr_name = 'planet-distance' . $i;
        //     $planet_attr[$attr_name] = $planet_attr[$attr_name] < MIN_DISTANCE ? MIN_DISTANCE : MAX_DISTANCE;
        //     $planet_attr[$attr_name] = $planet_attr[$attr_name] < MIN_DISTANCE ? MIN_DISTANCE : MAX_DISTANCE;
            
        //     $attr_name = 'planet-speed' . $i;
        //     $planet_attr[$attr_name] = $planet_attr[$attr_name] < MIN_SPEED ? MIN_SPEED : MAX_SPEED;
        //     $planet_attr[$attr_name] = $planet_attr[$attr_name] < MIN_SPEED ? MIN_SPEED : MAX_SPEED;
            
        //     $attr_name = 'planet-size' . $i;
        //     $planet_attr[$attr_name] = $planet_attr[$attr_name] < MIN_SIZE ? MIN_SIZE : MAX_SIZE;
        //     $planet_attr[$attr_name] = $planet_attr[$attr_name] < MIN_SIZE ? MIN_SIZE : MAX_SIZE;
            
        // }


        // foreach($planet_attr as $key => $val){
        //     echo ($key . ": " . $val . '<br>');
        // }
        ?>
        <script src="js/action.js"></script>
    </body>
</html>
