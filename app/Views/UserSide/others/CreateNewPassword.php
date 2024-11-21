<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Password</title>
</head>
<body>
    <form action="<?= base_url('/account/resetPassword') ?>" method="post">
        <label for="pass">create new password</label>
        <input type="password" name="pass" id="pass">
        <br>
        <label for="cpass">confirm password</label>
        <input type="password" name="cpass" id="cpass"> &nbsp;
        <?php if(session()->getFlashdata('error')) :?> <span style="color: red;">*<?= session()->getFlashdata('error') ?></span> <?php endif;?>
        <br>
        <input type="submit" value="Save new password">
    </form>
</body>
</html>