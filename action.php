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
        <link rel="stylesheet" href="css/action.css">

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
        <?php
        const MAX_PLANETS = 4;
        const ATTR_COUNT = 4;

        const MIN_DISTANCE = 1;
        const MAX_DISTANCE = 4;
        const MIN_SPEED = -10;
        const MAX_SPEED = 10;
        const MIN_COLOR_VAL = 0;
        const MAX_COLOR_VAL = 0xFFFFFF;
        const MIN_NAME_LEN = 1;
        const MAX_NAME_LEN = 15;

        function is_last_val_present(){
            if(isset($_COOKIE['last_val_present'])){
                if($_COOKIE['last_val_present'] == true){
                    return true;
                }
            }
            return false;
        }

        $data = [];
        $planet_attr = [];
        $planet_count = 0;
            
        // check if being called by "render last"
        if(is_last_val_present() == true && count($_POST) == 0){
            $planet_attr = $_COOKIE;
        }else {
            adjustNewValues();
        }

        function adjustNewValues(){
            global $planet_attr, $planet_count;
            // get all the necessary values
            foreach($_POST as $key => $val){
                if(str_contains($key, "planet-")){
                    if(str_contains($key, "planet-name") || str_contains($key, "planet-color")){
                        $planet_attr[$key] = $val;
                    } else {
                        $planet_attr[$key] = intval($val);
                    }
                }
            }

            $planet_count = (count($planet_attr) / ATTR_COUNT);
            $planet_count = $planet_count > MAX_PLANETS ? MAX_PLANETS : $planet_count;
            setcookie("planet-count", $planet_count);

            $past = time() - 3600;
            foreach ( $_COOKIE as $key => $value )
            {
                setcookie( $key, $value, $past);
            }

            /* adjust values if they are not within the valid range */
            $attr_names = ["planet-distance", "planet-speed", "planet-color", "planet-name", ];
            $attr_max = array(MAX_DISTANCE, MAX_SPEED, MAX_COLOR_VAL, MAX_NAME_LEN);
            $attr_min = array(MIN_DISTANCE, MIN_SPEED, MIN_COLOR_VAL, MIN_NAME_LEN);

            for ($i=1; $i <= $planet_count; $i++) {
                for ($j = 0; $j < 3; $j++) {
                    $name = $attr_names[$j];
                    $attr_name = $name . $i;
                    $min = $attr_min[$j];
                    $max = $attr_max[$j];
                    $val = $planet_attr[$attr_name];

                    if ($name == "planet-name") {
                        // planet name must be handled differently
                        if (strlen($val) > $max){
                            $planet_attr[$attr_name] = substr($val, 0, $max);
                        }else {
                            $planet_attr[$attr_name] = $val;
                        }
                    } else if ($name == "planet-color"){
                        $val = str_replace("#", "", $val);
                        $val = intval($val, 16);
                        $val = $val > $max ? $max : ($val < $min ? $min : $val); 
                        $val = "#" . dechex($val);
                    }
                    else{
                        $val = ($val > $max) ? $max : ($val < $min ? $min : $val);
                        $planet_attr[$attr_name] = round($val, 0, PHP_ROUND_HALF_EVEN);
                    }
                    setcookie($attr_name, $planet_attr[$attr_name]);
                    $_COOKIE[$attr_name] = $planet_attr[$attr_name];
                }             
            }
            setcookie("last_val_present", "true");
            $_COOKIE['last_val_present'] = "true";
        }

        ?>
        <h1 class="">Your Solarsystem</h1>
        <main class="w3-content" id="main">
            <h3>Planet data</h3>
            <section id="dataSection1" class="planet-grid">
            <?php
                for ($i=1; $i <= $planet_count; $i++) {
                    $distance = $planet_attr["planet-distance" . $i];
                    $speed = $planet_attr["planet-speed" . $i];
                    $lap_duration = $distance / $speed;
            ?>
                    <div class="planet-data-col">
                        <p>Name</p>
                        <p class="w3-large"><?= $planet_attr["planet-name" . $i] ?></p>
                    </div>
                    <div class="planet-data-col">
                        <p>Lap duration</p>
                        <p class="w3-large"><?="{$lap_duration} years" ?></p>
                    </div>
                <?php } ?>
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
        </footer>
        <script src="js/action.js"></script>
    </body>
</html>
