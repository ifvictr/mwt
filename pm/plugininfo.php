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
                        echo "<h2>
                            <a href='http://forums.pocketmine.net/plugins/plugin.".$plugin["id"]."'>".$plugin["title"]."</a> by
                            <a href='http://forums.pocketmine.net/members/member.".$plugin["author_id"]."'>".$plugin["author_username"]."</a>
                        </h2>";
                        echo "External url: ".(empty($plugin["external_url"]) ? "N/A" : "<a href='".$plugin["external_url"]."'>".$plugin["external_url"]."</a>")."<br>";
                        echo "Created on: ".date("l F j, Y H:i:s e", $plugin["creation_date"])."<br>";
                        echo "Last updated on: ".(empty($plugin["last_update"]) ? "N/A" : date("l F j, Y H:i:s e", $plugin["last_update"]))."<br>";
                        echo "Featured on: ".(empty($plugin["feature_date"]) ? "N/A" : date("l F j, Y H:i:s e", $plugin["feature_date"]))."<br>";
                        echo <<<INFO
Id: {$plugin["id"]}<br>
Category: {$plugin["category_title"]}<br>
Times downloaded: {$plugin["times_downloaded"]}<br>
Times updated: {$plugin["times_updated"]}<br>
Times reviewed: {$plugin["times_reviewed"]}<br>
Times rated: {$plugin["times_rated"]}<br>
Rating sum: {$plugin["rating_sum"]}<br>
Rating average: {$plugin["rating_avg"]}<br>
Rating weighted: {$plugin["rating_weighted"]}<br>
Category id: {$plugin["category_id"]}<br>
Resource category id: {$plugin["resource_category_id"]}<br>
Current version id: {$plugin["current_version_id"]}<br>
Version id: {$plugin["version_id"]}<br>
Description id: {$plugin["description_id"]}<br>
Thread id: {$plugin["thread_id"]}<br>
Prefix id: {$plugin["prefix_id"]}<br>
Featured count: {$plugin["featured_count"]}<br>
INFO;
                        break;
                    }
                    if(++$count >= $data["count"]){
                        echo "<p class='error'>That plugin could not be found.</p>";
                        break;
                    }
                }
            }
            else{
                echo "<p class='error'>No plugin specified.</p>";
            }
            ?>
        </div>
    </body>
</html>