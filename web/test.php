<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    <h1>This is a php page</h1>
    <?php
        for ($i=1; $i<10; $i++) {
            if ($i%2 === 0) {
                echo "<div style='color:red' id=".$i."></div>";
            } else {
                echo "<div id=".$i."></div>";
            }
        }
    ?>
</body>
</html>