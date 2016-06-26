<html>
    <head>
        <title>string2hash | mwt</title>
        <meta charset="UTF-8">
        <link rel="icon" href="/images/favicon.png" type="image/png">
        <link rel="stylesheet" href="/assets/css/style.css">
    </head>
    <body>
        <h2><img src="/images/favicon.png"> et / string2hash</h2>
        <?php
        $string = $_GET["string"];
        $algo = $_GET["algo"];
        ?>
        <form action="string2hash.php" method="GET" id="form">
            String: <input type="text" name="string" value="<?php echo $string; ?>"><br>
            Algorithm: <input type="text" name="algo" value="<?php echo $algo; ?>"><br>
            <input type="submit" value="Check"><br>
            Currently supported hashing algorithms: <?php echo implode(", ", hash_algos()); ?>
        </form>
        <div id="result">
        <?php
        if(!empty($string) and !empty($algo)){
            try{
                echo "<p>Hashed <strong>$string</strong>, output is: <strong>".hash($algo, $string)."</strong>.</p>";
            }
            catch(\RuntimeException $exception){
                echo "<p class='error'>".$exception->getMessage()."</p>";
            }
        }
        else{
            echo "<p class='error'>No string and/or algorithm specified.</p>";
        }
        ?>
        </div>
    </body>
</html>