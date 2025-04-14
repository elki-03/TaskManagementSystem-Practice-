<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

<h1>Welcome to your Task Management System</h1>

<h2>Login</h2>

    <form action="<?php echo site_url('users/check_login'); ?>" method="POST" class="input-group mb-3">
        <label for="username"> Username </label>
        <input type="text" required name="username" id="username" value="<? echo set_value('username'); ?>"/><br />
        <label for="pw">Passwort</label>
        <input type="password" required name="pw" id="pw" /><br />
        <input type="submit" value="Login" />
        <input type="reset" value="Reset" />
    </form>

    <a href="<?php echo site_url('users/register'); ?>">Not yet registered?</a>

    <?php if (!empty($message)): ?>
      <p><?php echo $message; ?></p>
    <?php endif; ?> 

</body>
</html>