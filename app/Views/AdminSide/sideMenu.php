

<!-- Sidebar Start -->
<aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>

      <!-- logo -->
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="<?= base_url('/dashboard') ?>" class="text-nowrap logo-img">
            <img src="<?= base_url('assets/img/logo.png') ?>" width="150" alt="logo" />
          </a>
        </div>


        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">

            <!-- HEADER - HOME TITLE -->
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>

            <!-- DASHBOARD -->
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?= base_url("/admin/dashboard") ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>

                <!-- space between dashboard and the bottom menus -->
                <li class="nav-small-cap">
                  <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                </li>



            <!-- TRANSACTIONS  -->
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?= base_url("/admin/transactions") ?>" aria-expanded="false">
                <span>
                  <i class="fa-solid fa-store"></i>
                </span>
                <span class="hide-menu">Transactions</span>
              </a>
            </li>



            <!-- PRODUCT  -->
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?= base_url("/admin/products") ?>" aria-expanded="false">
                <span>
                  <i class="fa-solid fa-store"></i>
                </span>
                <span class="hide-menu">Gears </span>
              </a>
            </li>


            <!-- MANAGE USERS -->
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?= base_url("/admin/manageusers") ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-cards"></i>
                </span>
                <span class="hide-menu">Users</span>
              </a>
            </li>

            
            <!-- HEADING - dash line -->
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">---------------------------</span>
            </li>

            <!-- Log out button -->
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?= base_url("/admin/logoutAd") ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Logout</span>
              </a>
            </li>

            <!-- Register new admin button -->
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?= base_url("/admin/registerAd") ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-user-plus"></i>
                </span>
                <span class="hide-menu">Create new admin</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>

      <!-- Modal for login success -->
            <div class="bg">
              <div id="myModal" class="modal">
                <div class="modal-content">
                    <p><?php $message = session()->getFlashdata('success');
                        if (isset($message)) {
                            echo $message;
                        }?>
                    </p>
                  <span class="close">&times;</span>
                </div>
              </div>
            </div>
            
    </aside>
