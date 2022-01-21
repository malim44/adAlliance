<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles.css">
    <title>adAlliance</title>
</head>
<body>

    <?php
        include 'sql.php';
    ?>

    <div class="positionDiv">
        <label for="position">Position (1 or 2):</label>
        <input type="text" id="position" name="position" maxlength="1" oninput="this.value=this.value.replace(/[^1-2]/g,'');">
        <button id="fetchAd">Start</button>
    </div>
    <div id="advertising"></div>
    <script src="script.js"></script>
</body>
</html>
</html>