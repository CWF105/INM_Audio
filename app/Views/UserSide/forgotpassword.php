<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reset password</title>
</head>
<body>
    <form action="<?= base_url('/account/checkEmail') ?>" method="post">
        <label for="email">Enter Email</label> <br>
        <input type="email" name="email" id="email" placeholder="email" required> &nbsp;
        <?php if(session()->getFlashdata('error')) :?> <span style="color: red;">*<?= session()->getFlashdata('error') ?></span> <?php endif;?>
        <br>
        <input type="submit" value="reset password">
    </form>
</body>
</html>