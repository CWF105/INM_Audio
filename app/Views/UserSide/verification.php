<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email</title>
</head>
<body>
    <?php if(session()->getFlashdata('userError')) :?>
        <span style="color:red;font-size:14px;"><?= session()->getFlashdata('userError')?></span>
    <?php elseif(session()->getFlashdata('success')) :?>
        <span style="color:green; font-size: 14px;"><?=session()->getFlashdata('success')?></span>    
    <?php endif;?>

    <form action="<?= base_url('/account/verify-Email') ?>" method="post">
        <input type="text" name="code" id="code" required>
        <input type="submit" value="Verify">
    </form>
    <form action="<?= base_url('/account/resend-verification')?>" method="post">
        <button type="submit" style="border: 0px; background-color: ffffff; color:cornflowerblue;">Resend Code</button>
    </form>

</body>
</html>