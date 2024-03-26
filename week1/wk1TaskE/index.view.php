<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>wk1TaskE</title>
</head>
<body>
    <h1>Task for the day</h1>

    <ul>
        <li>
            <strong>Name: </strong> <?= $task['Title']; ?>
        </li>

        <li>
            <strong>Due Date: </strong> <?= $task['Due']; ?>
        </li>

        <li>
            <strong>Responsible: </strong> <?= $task['assigned_to']; ?>
        </li>

        <li>

            
            <strong>Status: </strong>
            
            <?php if ($task['completed']) : ?>

                <span class="icon">&#9989;</span>

            <?php else: ?>

                <span class="icon">Incomplete</span>
                
            <?php endif; ?>

        </li>
    </ul>

</body>
</html>