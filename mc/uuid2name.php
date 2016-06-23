<html>
    <head>
        <title>uuid2name | mwt</title>
        <meta charset="UTF-8">
        <link rel="icon" href="/images/favicon.png" type="image/png">
        <link rel="stylesheet" href="/assets/css/style.css">
    </head>
    <body>
        <h2><img src="/images/favicon.png"> mc / uuid2name</h2>
        <?php $uuid = $_GET["uuid"]; ?>
        <form action="uuid2name.php" method="GET" id="form">
            UUID: <input type="text" name="uuid"><br>
            <input type="submit" value="Check">
        </form>
        <div id="result">
        <?php
        if(!empty($uuid)){
            $data = json_decode(file_get_contents("https://us.mc-api.net/v3/name/$uuid"), true);
            echo "$uuid leads to <strong>".$data["name"]."</strong>. Request took <strong>".$data["took"]."ms</strong> to retrieve from ".$data["source"].".";
        }
        else{
            echo "<p class='error'>No input UUID specified.</p>";
        }
        ?>
        </div>
    </body>
</html>