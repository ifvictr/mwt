<html>
    <head>
        <title>UUID2Name | Minecraft Web Tools</title>
        <meta charset="UTF-8">
        <link rel="icon" href="/images/favicon.png" type="image/png">
        <link rel="stylesheet" href="/assets/css/style.css">
    </head>
    <body>
        <?php $uuid = $_GET["uuid"]; ?>
        <form action="uuid2name.php" method="GET">
            UUID: <input type="text" name="uuid">
            <input type="submit" value="Check">
        </form>
        <div id="result">
        <?php
        if(isset($uuid) and !empty($uuid)){
            $data = json_decode(file_get_contents("https://us.mc-api.net/v3/name/".$uuid), true);
            echo $uuid." leads to <strong>".$data["name"]."</strong>, retrieved from ".$data["source"].". Request took <strong>".$data["took"]."</strong> second(s).";
        }
        else{
            echo "<p style='color:#ff0000;font-weight:bold;'>No input UUID specified.</p>";
        }
        ?>
        </div>
        <p>&copy; 2016 <a href="https://gamecrafter.github.io">Gamecrafter</a></p>
    </body>
</html>