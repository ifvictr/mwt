<!DOCTYPE html>
<html>
    <head>
        <title>name2uuid | mwt</title>
        <meta charset="utf-8">
        <link rel="icon" href="/images/favicon.png" type="image/png">
        <link rel="stylesheet" href="/assets/css/style.css">
    </head>
    <body>
        <h2><img src="/images/favicon.png"> mc / name2uuid</h2>
        <?php $name = $_GET["name"]; ?>
        <form action="name2uuid.php" method="get" id="form">
            Username: <input type="text" name="name" value="<?php echo $name; ?>"><br>
            <input type="submit" value="Check">
        </form>
        <div id="result">
        <?php
        if(!empty($name)){
            $data =  json_decode(file_get_contents("https://us.mc-api.net/v3/uuid/$name"), true);
            echo $data["name"] . "'s UUID is <strong>" . $data["full_uuid"] . "</strong>. Request took <strong>" . $data["took"] . "ms</strong> to retrieve from " . $data["source"] . ".";
        }
        else{
            echo "<p class='error'>No username specified.</p>";
        }
        ?>
        </div>
    </body>
</html>