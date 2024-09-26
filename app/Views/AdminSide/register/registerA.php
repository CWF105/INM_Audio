<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>INM Admin - admin registration(admin)</title>
  <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/css/logo.png') ?>" />
  <link rel="stylesheet" href="<?= base_url('Admin_Side_Assets/css/styles.min.css') ?>" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

  <style>
    .success-message {
      color: green;
    }
    .error-message {
      color: red;
    }
    .popup {
            display: none; /* Hidden by default */
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        /* Overlay */
        .overlay {
            display: none; /* Hidden by default */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        /* Success and error text colors */
        .text-success {
            color: green;
        }

        .text-danger {
            color: red;
        }
        .btn {
          background-color: transparent;
          padding: 7px;
          border: 1px solid black;
          border-radius: 6px;
          color:black;
        }
        .btn:hover {
          background-color: #444;
          color:white;
        }
  </style>
</head>

<body>
    <?php if (session()->getFlashdata('success')) :?>
        <div class="popup" id="popup" onload="showPopUp('<?php echo session()->getFlashdata('success'); ?>')">
          <div id="popupMessage" class="<?= session()->getFlashdata('success') ?>"><?php session()->getFlashdata('success') ?></div>
          <button onclick="closePopup()">Close</button>
        </div>
    <?php endif ;?>

    <?php if(session()->getFlashdata('error')) : ?>
        <div class="popup" id="popup" onload="showPopUp('<?php echo session()->getFlashdata('error'); ?>')">
          <div id="popupMessage" class="<?= session()->getFlashdata('error') ?>"><?php session()->getFlashdata('error') ?></div>
          <button class="btn" onclick="closePopup()">Close</button>
      </div>
    <?php endif ;?>

    
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">

                <p class="text-center">Register new Administrator account or <a href="<?= base_url('/admin/registerU') ?>">user account</a></p>

                <form action="<?= base_url('/admin/registerAdmin') ?>" method="post">


                  <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="username" required>
                  </div>

                  <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" id="email" required>
                  </div>

                  <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                  </div>

                  <div class="mb-4">
                    <label for="password" class="form-label">Confirm Password</label>
                    <input type="password" name="cpassword" class="form-control" id="cpassword" required>
                  </div>

                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign up</button>

                  <div class="d-flex align-items-center justify-content-center">
                    <a class="text-primary fw-bold ms-2" href="<?= base_url('/admin/dashboard') ?>">Cancel</a>
                  </div>
                </form>


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


    <!-- Overlay -->
    <div class="overlay" id="overlay"></div>
    <div class="popup" id="popup">
        <div id="popupMessage"></div>
        <button onclick="closePopup()">Close</button>
    </div>


    <script>
        function showPopup(message, type) {
            const popup = document.getElementById('popup');
            const overlay = document.getElementById('overlay');
            const popupMessage = document.getElementById('popupMessage');

            // Set message and styles based on type
            popupMessage.innerHTML = `<p class="${type === 'success' ? 'text-success' : 'text-danger'}">${message}</p>`;
            popup.style.display = 'block';
            overlay.style.display = 'block';
        }

        function closePopup() {
            const popup = document.getElementById('popup');
            const overlay = document.getElementById('overlay');

            popup.style.display = 'none';
            overlay.style.display = 'none';
        }

        // Show the popup if flash data exists
        document.addEventListener('DOMContentLoaded', function() {
            const successMessage = '<?= session()->getFlashdata('success') ?>';
            const errorMessage = '<?= session()->getFlashdata('error') ?>';
            
            if (successMessage) {
                showPopup(successMessage, 'success');
            } else if (errorMessage) {
                showPopup(errorMessage, 'error');
            }
        });
    </script>

  <script src="<?= base_url('Admin_Side_Assets/libs/jquery/dist/jquery.min.js') ?>"></script>
  <script src="<?= base_url('Admin_Side_Assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
