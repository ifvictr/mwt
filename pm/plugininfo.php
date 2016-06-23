<html>
    <head>
        <title>plugininfo | mwt</title>
        <meta charset="UTF-8">
        <link rel="icon" href="/images/favicon.png" type="image/png">
        <link rel="stylesheet" href="/assets/css/style.css">
    </head>
    <body>
        <h2><img src="/images/favicon.png"> pm / plugininfo</h2>
        <?php $name = strtolower($_GET["name"]); ?>
        <form action="plugininfo.php" method="GET" id="form">
            Plugin: <input type="text" name="name" value="<?php echo $name; ?>"><br>
            <input type="submit" value="Check">
        </form>
        <div id="result">
            <?php
            if(!empty($name)){
                $data = json_decode(file_get_contents("http://forums.pocketmine.net/api.php"), true);
                $count = 0;
                foreach($data["resources"] as $plugin){
                    if(strtolower($plugin["title"]) === $name){
                        foreach($plugin as $key => $value){
                            echo "$key: $value<br>";
                        }
                    }
                }
            }
            else{
                echo "<p class='error'>No input plugin name specified.</p>";
            }
            ?>
        </div>
    </body>
</html>