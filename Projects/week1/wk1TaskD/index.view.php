<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Week1 task D</title>
</head>
<body>
    <ul>
        <?php foreach ($task as $taskDesc => $taskInfo) : ?> 
            
            <li><strong><?= $taskDesc; ?></strong> <?= $task; ?></li>

        <?php endforeach; ?>
    </ul>
</body>
</html>