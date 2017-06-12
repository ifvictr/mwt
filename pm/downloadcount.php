<!DOCTYPE html>
<html>
    <head>
        <title>downloadcount | mwt</title>
        <meta charset="utf-8">
        <link rel="icon" href="/images/favicon.png" type="image/png">
        <link rel="stylesheet" href="/assets/css/style.css">
    </head>
    <body>
        <h2><img src="/images/favicon.png"> pm / downloadcount</h2>
        <?php
        try{
            $data = json_decode(file_get_contents("http://forums.pocketmine.net/api.php"), true);
        }
        catch(\RuntimeException $exception){
            echo "<p class='error'>An error occurred. Please try again later.</p>";
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
        <p>Statistics collected on <strong><?php echo date("l F j, Y H:i:s e"); ?></strong>.</p>
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
                <tr id="<?php echo "a:" . urlencode($user); ?>">
                    <td><?php echo ++$rank; ?></td>
                    <td><a href="#a:<?php echo urlencode($user); ?>"><?php echo $user; ?></a></td>
                    <td><?php echo number_format($data["downloads"]); ?></td>
                    <td><?php echo round(($data["downloads"] / $grandTotal) * 100, 3)."%"; ?></td>
                    <td><a href="userplugins.php?name=<?php echo urlencode($user); ?>"><?php echo number_format($data["plugins"]); ?></a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </body>
</html>