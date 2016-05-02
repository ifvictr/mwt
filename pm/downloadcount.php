<html>
    <head>
        <title>Download Count | Minecraft Web Tools</title>
        <meta charset="UTF-8">
        <link rel="icon" href="../images/favicon.png" type="image/png">
        <link rel="stylesheet" href="../assets/css/style.css">
        <style>
            table{
                width: 50%;
            }
            table, th, td{
                border: 1px solid #000000;
            }
            p, th, td{
                font-family: "Arial";
                padding: 6px;
                text-align: left;
            }
            h1{
                color: #ff0000;
                font-family: "Arial";
                font-size: 24px;
            }
            th{
                background: #ccffcc;
            }
            td{
                background: #eed2ee;
            }
        </style>
    </head>
    <body>
        <?php
        try{
            $data = json_decode(file_get_contents("http://forums.pocketmine.net/api.php"), true);
        }
        catch(\RuntimeException $exception){
            echo "<h1>An error occurred. Please try again later.</h1>";
        }
        $info = [];
        $grandTotal = 0;
        foreach($data["resources"] as $plugin){
            $user = $plugin["author_username"];
            $downloads = $plugin["times_downloaded"];
            if(array_key_exists($user, $info)){
                $info[$user]["downloads"] += $downloads;
                $info[$user]["plugins"] += 1;
            }
            else{
                $info[$user] = ["downloads" => $downloads, "plugins" => 1];
            }
            $grandTotal += $downloads;
        }
        arsort($info);
        $rank = 0;
        ?>
        <p>Statistics collected on <strong><?php echo date("F j, Y H:i:s e"); ?></strong>.</p>
        <table>
            <thead>
                <th>Total authors</th>
                <th>Total downloads</th>
                <th>Total plugins</th>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo count($info); ?></td>
                    <td><?php echo number_format($grandTotal); ?></td>
                    <td><?php echo number_format($data["count"]); ?></td>
                </tr>
            </tbody>
        </table>
        <table style="margin-top:8px;">
            <thead>
                <th>#</th>
                <th>Author</th>
                <th>Downloads</th>
                <th>Percentage</th>
                <th>Plugins</th>
            </thead>
            <tbody>
                <?php foreach($info as $user => $data): ?>
                <tr>
                    <td><?php echo ++$rank; ?></td>
                    <td><?php echo $user; ?></td>
                    <td><?php echo number_format($data["downloads"]); ?></td>
                    <td><?php echo round(($data["downloads"] / $grandTotal) * 100, 3)."%"; ?></td>
                    <td><?php echo number_format($data["plugins"]); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p>&copy; 2016 <a href="https://gamecrafter.github.io">Gamecrafter</a></p>
    </body>
</html>