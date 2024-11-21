<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/UserSide/verification.css')?>">
</head>
<body>
    <div class="container">

        <div class="verify-title">
            <h2>Enter verification code</h2>
            <?php if(session()->get('emailSendTo')) :?>
                <h4>We've sent a code to "<?= session()->get('emailSendTo'); ?>"</h4>
            <?php endif;?>
        </div>
    
        <form action="<?= base_url('/account/verify-Email') ?>" method="post">
            <div class="input-box">
                <div class="input-verify">
                    <input type="number" name="code1" id="code1" required maxlength="1" oninput="this.value=this.value.slice(0,1)">
                </div>
                <div class="input-verify">
                    <input type="number" name="code2" id="code2" required maxlength="1" oninput="this.value=this.value.slice(0,1)">
                </div>
                <div class="input-verify">
                    <input type="number" name="code3" id="code3" required maxlength="1" oninput="this.value=this.value.slice(0,1)">
                </div>
                <div class="input-verify">
                    <input type="number" name="code4" id="code4" required maxlength="1" oninput="this.value=this.value.slice(0,1)">
                </div>
                <div class="input-verify">
                    <input type="number" name="code5" id="code5" required maxlength="1" oninput="this.value=this.value.slice(0,1)">
                </div>
                <div class="input-verify">
                    <input type="number" name="code6" id="code6" required maxlength="1" oninput="this.value=this.value.slice(0,1)">
                </div>
            </div>
            <center>
                <?php if(session()->getFlashdata('userError')) :?>
                    <span style="color:red;font-size:14px;padding-top:5px;"><?= session()->getFlashdata('userError')?></span>
                <?php elseif(session()->getFlashdata('success')) :?>
                    <span style="color:green; font-size: 14px;padding-top:5px;"><?=session()->getFlashdata('success')?></span>    
                <?php endif;?>
            </center>
            <div class="verify-button">
                <a href="<?= base_url('/login') ?>"><button type="button">Cancel</button></a>   
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