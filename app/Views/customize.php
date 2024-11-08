
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=" <?= base_url('assets/css/customize.css') ?>">
    <link rel="stylesheet" href=" <?= base_url('assets/css/navbar.css') ?>">
    <link rel="stylesheet" href=" <?= base_url('assets/css/footer.css') ?>">
    <link rel="shortcut icon" href="<?= base_url(relativePath: 'assets/img/logo.png') ?>" type="image/x-icon">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>INM Shop</title>
    <script defer src="<?= base_url('assets/js/script2.js') ?>"></script>
</head>
<body>
    <?php 
        echo view("includes/header.php");
    ?>

<div class="customize">
    <div class="custom-ear">

        <img src="<?= base_url('assets/img/earphone.png') ?>">

        <div class="design-logo">   
            <img src="<?= base_url('assets/img/dinoo.png') ?>">
            <img src="<?= base_url('assets/img/dragon.png') ?>">
            <img src="<?= base_url('assets/img/lion.png') ?>">
        </div>
    </div>

    <div class="color-picker">
        <h3>Color</h3>
        <!-- <div class="header">
            <button class="tab active">Grid</button>
            <button class="tab">Spectrum</button>
            <button class="tab">Sliders</button>
        </div> -->
        <div class="color-grid">
            
            <div class="color-cell" style="background-color: #FFFFFF;"></div>
            <div class="color-cell" style="background-color: #C0C0C0;"></div>
            <div class="color-cell" style="background-color: #808080;"></div>
            <div class="color-cell" style="background-color: #000000;"></div>
            <div class="color-cell" style="background-color: #C0C0C0;"></div>
            <div class="color-cell" style="background-color: #C0C0C0;"></div>
            <div class="color-cell" style="background-color: #C0C0C0;"></div>
            <div class="color-cell" style="background-color: #C0C0C0;"></div>
            <div class="color-cell" style="background-color: #C0C0C0;"></div>
            <div class="color-cell" style="background-color: #C0C0C0;"></div>
            <div class="color-cell" style="background-color: #C0C0C0;"></div>
            <div class="color-cell" style="background-color: #000000;"></div>
       
            <div class="color-cell" style="background-color: #00374A;"></div>
            <div class="color-cell" style="background-color: #0042A9;"></div>
            <div class="color-cell" style="background-color: #004D65;"></div>
            <div class="color-cell" style="background-color: #0056D6;"></div>
            <div class="color-cell" style="background-color: #0061FD;"></div>
            <div class="color-cell" style="background-color: #007AFF;"></div>
            <div class="color-cell" style="background-color: #008CB4;"></div>
            <div class="color-cell" style="background-color: #00A1D8;"></div>
            <div class="color-cell" style="background-color: #011D57;"></div>
            <div class="color-cell" style="background-color: #012F7B;"></div>
            <div class="color-cell" style="background-color: #016E8F;"></div>
            <div class="color-cell" style="background-color: #01C7FC;"></div>
           
            <div class="color-cell" style="background-color: #00374A;"></div>
            <div class="color-cell" style="background-color: #0042A9;"></div>
            <div class="color-cell" style="background-color: #004D65;"></div>
            <div class="color-cell" style="background-color: #0056D6;"></div>
            <div class="color-cell" style="background-color: #0061FD;"></div>
            <div class="color-cell" style="background-color: #007AFF;"></div>
            <div class="color-cell" style="background-color: #008CB4;"></div>
            <div class="color-cell" style="background-color: #00A1D8;"></div>
            <div class="color-cell" style="background-color: #011D57;"></div>
            <div class="color-cell" style="background-color: #012F7B;"></div>
            <div class="color-cell" style="background-color: #016E8F;"></div>
            <div class="color-cell" style="background-color: #01C7FC;"></div>
      
            <div class="color-cell" style="background-color: #00374A;"></div>
            <div class="color-cell" style="background-color: #0042A9;"></div>
            <div class="color-cell" style="background-color: #004D65;"></div>
            <div class="color-cell" style="background-color: #0056D6;"></div>
            <div class="color-cell" style="background-color: #0061FD;"></div>
            <div class="color-cell" style="background-color: #007AFF;"></div>
            <div class="color-cell" style="background-color: #008CB4;"></div>
            <div class="color-cell" style="background-color: #00A1D8;"></div>
            <div class="color-cell" style="background-color: #011D57;"></div>
            <div class="color-cell" style="background-color: #012F7B;"></div>
            <div class="color-cell" style="background-color: #016E8F;"></div>
            <div class="color-cell" style="background-color: #01C7FC;"></div>
          
            <div class="color-cell" style="background-color: #00374A;"></div>
            <div class="color-cell" style="background-color: #0042A9;"></div>
            <div class="color-cell" style="background-color: #004D65;"></div>
            <div class="color-cell" style="background-color: #0056D6;"></div>
            <div class="color-cell" style="background-color: #0061FD;"></div>
            <div class="color-cell" style="background-color: #007AFF;"></div>
            <div class="color-cell" style="background-color: #008CB4;"></div>
            <div class="color-cell" style="background-color: #00A1D8;"></div>
            <div class="color-cell" style="background-color: #011D57;"></div>
            <div class="color-cell" style="background-color: #012F7B;"></div>
            <div class="color-cell" style="background-color: #016E8F;"></div>
            <div class="color-cell" style="background-color: #01C7FC;"></div>
           
            <div class="color-cell" style="background-color: #00374A;"></div>
            <div class="color-cell" style="background-color: #0042A9;"></div>
            <div class="color-cell" style="background-color: #004D65;"></div>
            <div class="color-cell" style="background-color: #0056D6;"></div>
            <div class="color-cell" style="background-color: #0061FD;"></div>
            <div class="color-cell" style="background-color: #007AFF;"></div>
            <div class="color-cell" style="background-color: #008CB4;"></div>
            <div class="color-cell" style="background-color: #00A1D8;"></div>
            <div class="color-cell" style="background-color: #011D57;"></div>
            <div class="color-cell" style="background-color: #012F7B;"></div>
            <div class="color-cell" style="background-color: #016E8F;"></div>
            <div class="color-cell" style="background-color: #01C7FC;"></div>
          
            <div class="color-cell" style="background-color: #00374A;"></div>
            <div class="color-cell" style="background-color: #0042A9;"></div>
            <div class="color-cell" style="background-color: #004D65;"></div>
            <div class="color-cell" style="background-color: #0056D6;"></div>
            <div class="color-cell" style="background-color: #0061FD;"></div>
            <div class="color-cell" style="background-color: #007AFF;"></div>
            <div class="color-cell" style="background-color: #008CB4;"></div>
            <div class="color-cell" style="background-color: #00A1D8;"></div>
            <div class="color-cell" style="background-color: #011D57;"></div>
            <div class="color-cell" style="background-color: #012F7B;"></div>
            <div class="color-cell" style="background-color: #016E8F;"></div>
            <div class="color-cell" style="background-color: #01C7FC;"></div>
          
            <div class="color-cell" style="background-color: #00374A;"></div>
            <div class="color-cell" style="background-color: #0042A9;"></div>
            <div class="color-cell" style="background-color: #004D65;"></div>
            <div class="color-cell" style="background-color: #0056D6;"></div>
            <div class="color-cell" style="background-color: #0061FD;"></div>
            <div class="color-cell" style="background-color: #007AFF;"></div>
            <div class="color-cell" style="background-color: #008CB4;"></div>
            <div class="color-cell" style="background-color: #00A1D8;"></div>
            <div class="color-cell" style="background-color: #011D57;"></div>
            <div class="color-cell" style="background-color: #012F7B;"></div>
            <div class="color-cell" style="background-color: #016E8F;"></div>
            <div class="color-cell" style="background-color: #01C7FC;"></div>
          
            <div class="color-cell" style="background-color: #00374A;"></div>
            <div class="color-cell" style="background-color: #0042A9;"></div>
            <div class="color-cell" style="background-color: #004D65;"></div>
            <div class="color-cell" style="background-color: #0056D6;"></div>
            <div class="color-cell" style="background-color: #0061FD;"></div>
            <div class="color-cell" style="background-color: #007AFF;"></div>
            <div class="color-cell" style="background-color: #008CB4;"></div>
            <div class="color-cell" style="background-color: #00A1D8;"></div>
            <div class="color-cell" style="background-color: #011D57;"></div>
            <div class="color-cell" style="background-color: #012F7B;"></div>
            <div class="color-cell" style="background-color: #016E8F;"></div>
            <div class="color-cell" style="background-color: #01C7FC;"></div>
            
            <div class="color-cell" style="background-color: #00374A;"></div>
            <div class="color-cell" style="background-color: #0042A9;"></div>
            <div class="color-cell" style="background-color: #004D65;"></div>
            <div class="color-cell" style="background-color: #0056D6;"></div>
            <div class="color-cell" style="background-color: #0061FD;"></div>
            <div class="color-cell" style="background-color: #007AFF;"></div>
            <div class="color-cell" style="background-color: #008CB4;"></div>
            <div class="color-cell" style="background-color: #00A1D8;"></div>
            <div class="color-cell" style="background-color: #011D57;"></div>
            <div class="color-cell" style="background-color: #012F7B;"></div>
            <div class="color-cell" style="background-color: #016E8F;"></div>
            <div class="color-cell" style="background-color: #01C7FC;"></div>
            
        </div>
        <div class="opacity-control">
            <!-- <h3>Opacity</h3> -->
            <input type="range" class="opacity-slider" min="0" max="100" value="100">
            <span class="opacity-value">100%</span>
        </div>
        <div class="recent-colors">
            <div class="recent-color" style="background-color: #8a4aff;"></div>
            <div class="recent-color" style="background-color: #000000;"></div>
            <div class="recent-color" style="background-color: #1e90ff;"></div>
            <div class="recent-color" style="background-color: #00ff00;"></div>
            <div class="recent-color" style="background-color: #ffff00;"></div>
            <div class="recent-color" style="background-color: #ff0000;"></div>
            <button class="add-color">+</button>
        </div>
        <div class="upload">
            <button>Upload Image</button>
        </div>
        <div class="submit">
            <button>Reset</button>
            <button>Submit</button>
        </div>

    </div>
  </div>

  <?php 
        echo view("includes/footer.php");
    ?>
</body>
</html>