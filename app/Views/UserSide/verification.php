<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/UserSide/verification.css')?>">
</head>
<body>
    <?php if(session()->getFlashdata('userError')) :?>
        <span style="color:red;font-size:14px;"><?= session()->getFlashdata('userError')?></span>
    <?php elseif(session()->getFlashdata('success')) :?>
        <span style="color:green; font-size: 14px;"><?=session()->getFlashdata('success')?></span>    
    <?php endif;?>
    <div class="container">

        <div class="verify-title">
            <h2>Enter verification code</h2>
            <h4>We've sent a code to "email"</h4>
        </div>
    
        <form action="<?= base_url('/account/verify-Email') ?>" method="post">

            <div class="input-box">
                <div class="input-verify">
                    <input type="text" name="code" id="code" required>
                </div>
                <div class="input-verify">
                    <input type="text" name="code" id="code1" required>
                </div>
                <div class="input-verify">
                    <input type="text" name="code" id="code2" required>
                </div>
                <div class="input-verify">
                    <input type="text" name="code" id="code3" required>
                </div>
                <div class="input-verify">
                    <input type="text" name="code" id="code4" required>
                </div>
                <div class="input-verify">
                    <input type="text" name="code" id="code5" required>
                </div>
            </div>
            <div class="verify-button">
                <button>Cancel</button>
                <input type="submit" value="Verify">
            </div>
        </form>

        <div class="form-resend">
            <form action="<?= base_url('/account/resend-verification')?>" method="post">
                <h4>Didn't get code?</h4>
                <button type="submit">Resend Code</button>
            </form>
        </div>
    </div>

</body>
</html>