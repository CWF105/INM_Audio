<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=" <?= base_url('assets/css/purchase-sucess.css') ?>">
    <title>Purchase Complete!</title>
</head>
<body>
    <div class="container">
        <div class="body">
            <img src="  <?= base_url('assets/img/purchase-success/success.png') ?>" alt="">
            <p class="sentence1">Your order has been received!</p>
            <p class="sentence2">We appreciate your business and look forward to serving you again in the future.</p>
        </div>
    </div>
    <div class="back">
        <a href=" <?= base_url('/shop') ?>">Go Back to Shop</a> &nbsp;|&nbsp;
        <a href=" <?= base_url('/user/setting') ?>">view order</a>
    </div>
    
</body>
</html>