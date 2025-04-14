<!-- Task list with options to filter, update, and delete tasks (tasks/index.php) -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index view</title>
    <style>
       .btn {
        /*
        border: 2px solid black;
        */
        border-radius: 5px;
        padding: 2px 3px;
    }
    /* more space within table */
    td {
        padding: 7px;
    }
    </style>
</head>
<body>

    <h1>Tasks Index</h1>

    <!-- buttons for new task and logout -->
    <a href="<?php echo site_url('tasks/button_create'); ?>" class="btn">New Task</a>
    <a href="<?= site_url('tasks/logout'); ?>" class="btn" style="float: right;">Logout</a>
    <br>
    <br>

    <!-- drop-down-filter -->
    <!-- loads form helper-->
    <?php $this->load->helper('form'); ?>

    <!-- start of form: get, so filter stays in url -->
    <?php echo form_open('tasks/index', ['method' => 'get']); ?>

    <?php
        //options-array for drop down
        $options = [
            '' => 'All Tasks',       // ''--> no filter
            'pending' => 'Pending',
            'completed' => 'Completed'
        ];

        // get currend filter from url so it is set before use
        $current_filter = $this->input->get('filter');

        // shows Dropdown:
        // - Name = "filter" (important so`input->get('filter')` is functioning
        // - options = defined Array from above
        // - current filter = currently active in filter
        // - Extra HTML: onchange so form sends itself directly
        echo form_dropdown(
            'filter',
            $options,
            $current_filter,
            'onchange="this.form.submit()" style="margin-bottom: 15px;"'
        );
    ?>
    <!-- end of form -->
    <?php echo form_close(); ?>

    <table border="1" style="margin-top: 20px; margin-bottom: 20px;">
        <tr>
            <th>Task</th>
            <th>Completed</th>
            <th>Pending</th>   
            <th>Action</th> 
        </tr>
        <?php foreach ($tasks as $task): ?>
        <tr>
            <!-- shows "x" and ""(empty space) instead of boolean-->
            <td><?= $task->task ?></td>
            <td><?= $task->completed ? 'x' : '' ?></td> 
            <td><?= $task->pending ? 'x' : '' ?></td>
            <td>

            <!-- Update and Delete-Buttons -->
            <a href="<?= site_url('tasks/update/' . $task->task_id); ?>" class="btn">Task completed</a>
            <a href="<?= site_url('tasks/delete/' . $task->task_id); ?>" class="btn" onclick="return confirm('Do you really want to delete this task?');">Delete</a>            
            </td> 
        </tr>
        <?php endforeach; ?>
    </table>

    <?php if (!empty($message)): ?>
      <p><?php echo $message; ?></p>
    <?php endif; ?>
    
</body>
</html>