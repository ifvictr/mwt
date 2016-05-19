<html>
    <head>
        <title>String2Hash | Minecraft Web Tools</title>
        <meta charset="UTF-8">
        <link rel="icon" href="/images/favicon.png" type="image/png">
        <link rel="stylesheet" href="/assets/css/style.css">
    </head>
    <body>
        <?php 
        $string = $_GET["string"];
        $algo = $_GET["algo"];
        ?>
        <form action="string2hash.php" method="GET">
            String: <input type="text" name="string" value="<?php echo $string; ?>">
            Algorithm: <input type="text" name="algo" value="<?php echo $algo; ?>">
            <input type="submit" value="Check">
        </form>
        <div id="result">
        <?php
        try{
            echo "<p>Hashed <strong>".$string."</strong>, output is: <strong>".hash($algo, $string)."</strong>.</p>";
        }
        catch(\RuntimeException $exception){
            echo "<p style='color:#ff0000;font-weight:bold;'>".$exception->getMessage()."</p>";
        }
        ?>
        </div>
        <p>&copy; 2016 <a href="https://gamecrafter.github.io">Gamecrafter</a></p>
    </body>
</html>