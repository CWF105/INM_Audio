<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Registration</title>
  <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/css/logo.png') ?>" />
  <link rel="stylesheet" href="<?= base_url('AdminSideAssets/css/styles.min.css') ?>" />

  <style>
    #notificationModal {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .modal-content {
      padding: 20px;
      border-radius: 5px;
      position: relative;
      text-align: center;
      width: 300px;
    }

    .close-btn {
      position: absolute;
      top: 10px;
      right: 10px;
      cursor: pointer;
      font-size: 18px;
    }
  </style>
</head>

<body>
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">

                <p class="text-center">Register new Administrator account</p>

                <form action="<?= base_url('/admin/addNewAdmin') ?>" method="post">
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

                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign up</button>

                  <div class="d-flex align-items-center justify-content-center">
                    <a class="text-primary fw-bold ms-2" href="<?= base_url('/admin') ?>">Cancel</a>
                  </div>
                </form>

                <div id="notificationModal" style="display: none;">
                  <div class="modal-content">
                    <span class="close-btn" onclick="closeModal()">&times;</span>
                    <p id="modalMessage"></p>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="<?= base_url('AdminSideAssets/libs/jquery/dist/jquery.min.js') ?>"></script>
  <script src="<?= base_url('AdminSideAssets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
  <script>
    function showModal(message, type) {
      const modal = document.getElementById('notificationModal');
      const modalContent = document.querySelector('.modal-content');

      document.getElementById('modalMessage').innerText = message;

      if (type === 'success') {
        modalContent.style.backgroundColor = '#d4edda';
        modalContent.style.color = '#155724';
      } else if (type === 'error') {
        modalContent.style.backgroundColor = '#f8d7da';
        modalContent.style.color = '#721c24';
      }

      modal.style.display = 'flex';
    }

    function closeModal() {
      document.getElementById('notificationModal').style.display = 'none';
    }

    <?php if (session()->getFlashdata('success')): ?>
      showModal('<?= session()->getFlashdata('success'); ?>', 'success');
    <?php elseif (session()->getFlashdata('error')): ?>
      showModal('<?= session()->getFlashdata('error'); ?>', 'error');
    <?php endif; ?>
  </script>

</body>
</html>
