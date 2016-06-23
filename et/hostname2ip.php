<html>
    <head>
        <title>hostname2ip | mwt</title>
        <meta charset="UTF-8">
        <link rel="icon" href="/images/favicon.png" type="image/png">
        <link rel="stylesheet" href="/assets/css/style.css">
    </head>
    <body>
        <h2><img src="/images/favicon.png"> et / hostname2ip</h2>
        <?php $hostname = strtolower($_GET["hostname"]); ?>
        <form action="hostname2ip.php" method="GET" id="form">
            Hostname: <input type="text" name="hostname" value="<?php echo $hostname; ?>"><br>
            <input type="submit" value="Check"><br>
        </form>
        <div id="result">
            <?php
            if(!empty($hostname)){
                $out = gethostbyname($hostname);
                if($hostname === $out){
                    echo "<p class='error'>\"$hostname\" does not appear to be a valid hostname.</p>";
                }
                else{
                    echo "<p>$hostname's IPv4 address is: <strong>$out</strong>.</p>";
                }
            }
            else{
                echo "<p class='error'>No hostname specified.</p>";
            }
            ?>
        </div>
    </body>
</html>