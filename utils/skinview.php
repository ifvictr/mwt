<html>
    <head>
        <title>Skin View | Minecraft Web Tools</title>
        <meta charset="UTF-8">
        <link rel="icon" href="../images/favicon.png" type="image/png">
        <link rel="stylesheet" href="../assets/css/style.css">
    </head>
    <body>
        <?php
        $name = $_GET["name"];
        $size = is_numeric($_GET["size"]) ? $_GET["size"] : 140;
        $ac = ((bool) $_GET["ac"] === true or (bool) $_GET["ac"] === false) ? (string) $_GET["ac"] : "true";
        $view = ((int) $_GET["view"] === 2 or (int) $_GET["view"] === 3 or (int) $_GET["view"] === 360) ? (int) $_GET["view"] : 2;
        $type = (strtolower($_GET["type"]) === "png" or strtolower($_GET["type"]) === "raw") ? strtolower($_GET["type"]) : "png";
        ?>
        <form action="skinview.php" method="GET">
            Username: <input type="text" name="name" value="<?php echo $name; ?>">
            Size: <input type="number" name="size" value="<?php echo $size; ?>">
            Show accessories: <select name="ac">
                <option value="true" <?php if($ac === "true") echo "selected"; ?>>Yes</option>
                <option value="false" <?php if($ac === "false") echo "selected"; ?>>No</option>
            </select>
            View: <select name="view">
                <option value="2" <?php if($view === 2) echo "selected"; ?>>2D</option>
                <option value="3" <?php if($view === 3) echo "selected"; ?>>3D</option>
                <option value="360" <?php if($view === 360) echo "selected"; ?>>360&deg;</option>
            </select>
            Filetype: <select name="type">
                <option value="png" <?php if($type === "png") echo "selected"; ?>>PNG</option>
                <option value="raw" <?php if($type === "raw") echo "selected"; ?>>Raw</option>
            </select>
            <input type="submit" value="View">
        </form>
        <div id="result">
            <?php
            if(isset($name) and !empty($name)){
                switch($type){
                    case "raw":
                        echo "<img src='https://mcapi.ca/skin/file/".$name."'>";
                        break;
                    case "png":
                        if($view === 2 or $view === 3){
                            echo "<img src='https://mcapi.ca/skin/".$view."d/".$name."/".$size."/".$ac."'>";
                        }
                        elseif($view === 360){
                            echo "<img src='../assets/php/skin360.php?name=".$name."&size=".$size."'>";
                        }
                        break;
                }
            }
            else{
                echo "<p style='color:#ff0000;font-weight:bold;'>No input username specified.</p>";
            }
            ?>
        </div>
        <p>&copy; 2016 <a href="https://gamecrafter.github.io">Gamecrafter</a></p>
    </body>
</html>