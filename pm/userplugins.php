<!DOCTYPE html>
<html>
    <head>
        <title>userplugins | mwt</title>
        <meta charset="utf-8">
        <link rel="icon" href="/images/favicon.png" type="image/png">
        <link rel="stylesheet" href="/assets/css/style.css">
    </head>
    <body>
        <h2><img src="/images/favicon.png"> pm / userplugins</h2>
        <?php $name = strtolower($_GET["name"]); ?>
        <form action="userplugins.php" method="get" id="form">
            Username: <input type="text" name="name" value="<?php echo $name; ?>"><br>
            <input type="submit" value="Check">
        </form>
        <div id="result">
            <?php
            if(!empty($name)){
                $data = json_decode(file_get_contents("http://forums.pocketmine.net/api.php"), true);
                $count = 0;
                echo "<ol>";
                foreach($data["resources"] as $plugin){
                    if(strtolower($plugin["author_username"]) === $name){
                        echo "<li><a href='plugininfo.php?name=" . urlencode($plugin["title"]) . "'>" . $plugin["title"] . "</a>: " . number_format($plugin["times_downloaded"]) . "</li>";
                        $count++;
                    }
                }
                echo "</ol>";
                echo "$name has a total of <strong>$count</strong> plugin(s).";
            }
            else{
                echo "<p class='error'>No username specified.</p>";
            }
            ?>
        </div>
    </body>
</html>