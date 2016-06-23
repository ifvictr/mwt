<html>
    <head>
        <title>hostname2ip | mwt</title>
        <meta charset="UTF-8">
        <link rel="icon" href="/images/favicon.png" type="image/png">
        <link rel="stylesheet" href="/assets/css/style.css">
    </head>
    <body>
        <h2><img src="/images/favicon.png"> et / ip2hostname</h2>
        <?php $ip = strtolower($_GET["ip"]); ?>
        <form action="ip2hostname.php" method="GET" id="form">
            IPv4 address: <input type="text" name="ip" value="<?php echo $ip; ?>"><br>
            <input type="submit" value="Check"><br>
        </form>
        <div id="result">
            <?php
            if(!empty($ip)){
                $out = gethostbyaddr($ip);
                if($ip === $out or !$out){
                    echo "<p class='error'>\"$ip\" does not appear to be a valid IPv4 address.</p>";
                }
                else{
                    echo "<p>$ip's hostname is: <strong>$out</strong>.</p>";
                }
            }
            else{
                echo "<p class='error'>No IPv4 address specified.</p>";
            }
            ?>
        </div>
    </body>
</html>