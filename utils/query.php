<html>
    <head>
        <title>Query | Minecraft Web Tools</title>
        <meta charset="UTF-8">
        <link rel="icon" href="../images/favicon.png" type="image/png">
        <link rel="stylesheet" href="../assets/css/style.css">
    </head>
    <body>
        <?php
        $ip = $_GET["address"];
        $port = $_GET["port"];
        ?>
        <form action="query.php" method="GET">
            Address: <input type="text" name="address" value="<?php echo $ip; ?>">
            Port: <input type="number" name="port" value="<?php echo $port; ?>">
            <input type="submit" value="Query">
        </form>
        <div id="result">
            <?php
            require "../assets/php/MinecraftQuery.php";
            require "../assets/php/MinecraftQueryException.php";
            if(isset($ip) and isset($port) and !empty($ip) and !empty($port)){
                $query = new MinecraftQuery();
                try{
                    $query->connect($ip, $port);
                    echo "<h2>Info:</h2>";
                    $info = $query->getInfo();
                    echo "Hostname: ".$info["hostname"]."<br>";
                    echo "Host IP: ".$info["hostip"]."<br>";
                    echo "Host port: ".$info["hostport"]."<br>";
                    echo "Version: ".$info["version"]."<br>";
                    echo "Engine: ".$info["server_engine"]."<br>";
                    echo "Gametype: ".$info["gametype"]."<br>";
                    echo "Game ID: ".$info["game_id"]."<br>";
                    echo "Map: ".$info["map"]."<br>";
                    echo "Players: ".$info["numplayers"]."/".$info["maxplayers"]."<br>";
                    $plugins = $info["plugins"];
                    sort($plugins);
                    echo "<h2>Plugins (".count($plugins)."):</h2>";
                    echo "<ul>";
                    foreach($plugins as $plugin){
                        echo "<li>".$plugin."</li>";
                    }
                    echo "</ul>";
                    $players = $query->getPlayers();
                    sort($players);
                    echo "<h2>Players (".count($players)."):</h2>";
                    echo "<ul>";
                    foreach($players as $player){
                        echo "<li>".$player."</li>";
                    }
                    echo "</ul>";
                }
                catch(MinecraftQueryException $exception){
                    echo "<p style='color:#ff0000;font-weight:bold;'>".$exception->getMessage()."</p>";
                }
            }
            else{
                echo "<p style='color:#ff0000;font-weight:bold;'>No input address and/or port specified.</p>";
            }
            ?>
        </div>
        <p>&copy; 2016 <a href="https://gamecrafter.github.io">Gamecrafter</a></p>
    </body>
</html>