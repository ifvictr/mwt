<html>
    <head>
        <title>pwgen | Minecraft Web Tools</title>
        <meta charset="UTF-8">
        <link rel="icon" href="/images/favicon.png" type="image/png">
        <link rel="stylesheet" href="/assets/css/style.css">
        <script src="/assets/js/jquery.min.js"></script>
    </head>
    <body>
        <h2><img src="/images/favicon.png"> et / pwgen</h2>
        <form id="form">
            Length: <input type="number" id="length" minlength="1" maxlength="256" value="16"><br>
            Options:<br>
            <input type="checkbox" id="lowercaseLetters"> Lowercase letters<br>
            <input type="checkbox" id="uppercaseLetters"> Uppercase letters<br>
            <input type="checkbox" id="numbers"> Numbers<br>
            <input type="checkbox" id="symbols"> Symbols<br>
            <input type="checkbox" id="spaces"> Spaces<br>
            <input type="button" id="submit" value="Generate">
        </form>
        <div id="result"></div>
        <p>&copy; 2016 <a href="https://gamecrafter.github.io">Gamecrafter</a></p>
    </body>
    <script>
        $("#submit").click(function(){
            generate();
        });
        function generate(){
            var optionsList = {
                "lowercaseLetters": "abcdefghijklmnopqrstuvwxyz",
                "uppercaseLetters": "ABCDEFGHIJKLMNOPQRSTUVWXYZ",
                "numbers": "0123456789",
                "symbols": "`~!@#$%^&*()-_=+[{]}\\|;:'\",<.>/?",
                "spaces": " "
            };
            var options = "";
            for(var key in optionsList){
                if($("#"+key).prop("checked")) options += optionsList[key];
            }
            var pw = "";
            for(var i = 0; i < parseInt($("#length").val()); i++){
                pw += options.charAt(Math.floor(Math.random() * options.length));
            }
            $("#result").html(pw);
        }
    </script>
</html>