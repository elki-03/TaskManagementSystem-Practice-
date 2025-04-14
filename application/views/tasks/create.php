<!-- Task creation form (tasks/create.php).$route['tasks/delete/(:num)'] = 'tasks/delete/$1';  -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Task</title>
</head>
<body>
    
</body>
</html>

<!-- new task -->
<form action="<?php echo site_url('tasks/create') ?>" method ="POST">
    <input type = "text" name="task" required>
    <button type = "submit">New Task</button>
</form>
<br>

<!-- for messages -->
<?php if (!empty($message)): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>
        
</body>
</html>