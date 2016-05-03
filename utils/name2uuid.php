<html>
    <head>
        <title>Name2UUID | Minecraft Web Tools</title>
        <meta charset="UTF-8">
        <link rel="icon" href="/images/favicon.png" type="image/png">
        <link rel="stylesheet" href="/assets/css/style.css">
    </head>
    <body>
        <?php $name = $_GET["name"]; ?>
        <form action="name2uuid.php" method="GET">
            Username: <input type="text" name="name" value="<?php echo $name; ?>">
            <input type="submit" value="Check">
        </form>
        <div id="result">
        <?php
        if(isset($name) and !empty($name)){
            $data =  json_decode(file_get_contents("https://us.mc-api.net/v3/uuid/".$name), true);
            echo $data["name"]."'s UUID is <strong>".$data["full_uuid"]."</strong>. Request took <strong>".$data["took"]."</strong> second(s) to retrieve from ".$data["source"].".";
        }
        else{
            echo "<p style='color:#ff0000;font-weight:bold;'>No input username specified.</p>";
        }
        ?>
        </div>
        <p>&copy; 2016 <a href="https://gamecrafter.github.io">Gamecrafter</a></p>
    </body>
</html>