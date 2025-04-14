<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h2>Your Registration for Welcome to Task Management System </h2>

    <p>Please use a Password with 11 or more of at least one symbol(!"§$%&/()=#), at least one letter of the english alphabet (at least one upper, and one at least lower case), and at least one number</p>

    <form action="<?php echo site_url('Users/register'); ?>" method="POST" class="input-group mb-3">

        <label for="username"> Username </label>

        <input type="text" required name="username" id="username" value="<? echo set_value('username'); ?>" /><br>
        <!-- value/set_value returns old posted data (username) in case of a validation error message or other (special request from Yvonne :) ) -->
        <?php echo validation_errors(); ?>
        <!-- shows valid_password()-error-messages -->
        <input type="submit" value="Register" />
        <input type="reset" value="Reset" />
    </form>
    
    <br>
    <br>
    <br>

    <?php if (!empty($message)): ?>
      <p><?php echo $message; ?></p>
    <?php endif; ?> 

    <br>
    <br>
    <br>
</body>
</html>



