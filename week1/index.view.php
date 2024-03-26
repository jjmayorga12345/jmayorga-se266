<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>week 1</title>

    <style>

        header{
            background: #e3e3e3;
            padding: 2em;
            text-align:center;
        }
    </style>

</head>
<body>
    <header>
        <ul>
            <?php

                foreach ($animals as $animal){
                    echo "<li>$animal</li>";
                }

            ?>
        </ul>
    </header>
</body>
</html>