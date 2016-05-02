<html>
    <head>
        <title>User Plugins | Minecraft Web Tools</title>
        <meta charset="UTF-8">
        <link rel="icon" href="../images/favicon.png" type="image/png">
        <link rel="stylesheet" href="../assets/css/style.css">
    </head>
    <body>
        <?php $name = $_GET["name"]; ?>
        <form action="userplugins.php" method="GET">
            Username: <input type="text" name="name" value="<?php echo $name; ?>">
            <input type="submit" value="Check">
        </form>
        <div id="result">
            <?php
            if(isset($name) and !empty($name)){
                $data = json_decode(file_get_contents("http://forums.pocketmine.net/api.php"), true);
                $count = 0;
                foreach($data["resources"] as $plugin){
                    if(strtolower($plugin["author_username"]) === strtolower($name)){
                        echo $plugin["title"].": ".$plugin["times_downloaded"]."<br>";
                        $count++;
                    }
                }
                echo "This user has a total of <strong>".$count."</strong> plugin(s).";
            }
            else{
                echo "<p style='color:#ff0000;font-weight:bold;'>No input username specified.</p>";
            }
            ?>
        </div>
        <p>&copy; 2016 <a href="https://gamecrafter.github.io">Gamecrafter</a></p>
    </body>
</html>