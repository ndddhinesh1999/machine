 <?php

    $uri = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    $url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    ?>
 <!-- Sidebar Start -->
 <aside class="left-sidebar">
     <!-- Sidebar scroll-->
     <div>
         <div class="brand-logo d-flex align-items-center justify-content-between">
             <div class="d-flex justify-content-center w-100">
                 <a href="<?= PROJECT_PATH . 'src/html/home/'; ?>" class="text-nowrap logo-img">
                     <img src="<?= PROJECT_PATH; ?>/src/assets/images/logos/company-logo.svg" width="70" alt="" />
                 </a>
             </div>
             <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                 <i class="ti ti-x fs-8"></i>
             </div>
         </div>
         <!-- Sidebar navigation-->
         <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
             <ul id="sidebarnav">
                 <li class="nav-small-cap">
                     <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                     <span class="hide-menu">Home</span>
                 </li>
                 <li class="sidebar-item">
                     <a class="sidebar-link" href="<?= PROJECT_PATH . 'src/html/home/'; ?>" aria-expanded="false">
                         <span>
                             <i class="ti ti-layout-dashboard"></i>
                         </span>
                         <span class="hide-menu">Dashboard</span>
                     </a>
                 </li>
                 <li class="nav-small-cap">
                     <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                     <span class="hide-menu">Masters</span>
                 </li>
                 <?php if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') { ?>
                     <li class="sidebar-item">
                         <a class="sidebar-link" href="<?= PROJECT_PATH . 'src/html/company/'; ?>" aria-expanded="false">
                             <span>
                                 <i class="bi bi-globe-americas fs-6"></i>
                             </span>
                             <span class="hide-menu">Company</span>
                         </a>
                     </li>
                 <?php } ?>
                 <?php if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin' || $_SESSION[SESS . 'session_admin_users_level'] == 'company') { ?>
                     <li class="sidebar-item">
                         <a class="sidebar-link" href="<?= PROJECT_PATH . 'src/html/branch/'; ?>" aria-expanded="false">
                             <span>
                                 <i class="bi bi-diagram-3 fs-6"></i>
                             </span>
                             <span class="hide-menu">Branch</span>
                         </a>
                     </li>
                 <?php } ?>
                 <?php if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin' || $_SESSION[SESS . 'session_admin_users_level'] == 'company') { ?>
                     <li class="sidebar-item">
                         <a class="sidebar-link" href="<?= PROJECT_PATH . 'src/html/category/'; ?>" aria-expanded="false">
                             <span>
                                 <i class="bi bi-diagram-3 fs-6"></i>
                             </span>
                             <span class="hide-menu">category</span>
                         </a>
                     </li>
                 <?php } ?>
                 <?php if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin' || $_SESSION[SESS . 'session_admin_users_level'] == 'company') { ?>
                     <li class="sidebar-item">
                         <a class="sidebar-link" href="<?= PROJECT_PATH . 'src/html/machine/'; ?>" aria-expanded="false">
                             <span>
                                 <i class="bi bi-diagram-3 fs-6"></i>
                             </span>
                             <span class="hide-menu">machine</span>
                         </a>
                     </li>
                 <?php } ?>
                 <?php if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin' || $_SESSION[SESS . 'session_admin_users_level'] == 'company' || $_SESSION[SESS . 'session_admin_users_level'] == 'branch') { ?>
                     <li class="sidebar-item">
                         <a class="sidebar-link" href="<?= PROJECT_PATH . 'src/html/department/'; ?>" aria-expanded="false">
                             <span>
                                 <i class="ti ti-cards"></i>
                             </span>
                             <span class="hide-menu">Department</span>
                         </a>
                     </li>
                     <li class="sidebar-item">
                         <a class="sidebar-link" href="<?= PROJECT_PATH . 'src/html/designation/'; ?>" aria-expanded="false">
                             <span>
                                 <i class="bi bi-clipboard2-data fs-6"></i>
                             </span>
                             <span class="hide-menu">Designation</span>
                         </a>
                     </li>
                     <li class="sidebar-item">
                         <a class="sidebar-link" href="<?= PROJECT_PATH . 'src/html/employee/'; ?>" aria-expanded="false">
                             <span>
                                 <i class="ti ti-user"></i>
                             </span>
                             <span class="hide-menu">Employee</span>
                         </a>
                     </li>

                 <?php } ?>
                 <!-- <?php if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin' || $_SESSION[SESS . 'session_admin_users_level'] == 'company' || $_SESSION[SESS . 'session_admin_users_level'] == 'branch') { ?>
                     <li class="sidebar-item">
                         <a class="sidebar-link" href="<?= PROJECT_PATH . 'src/html/features/'; ?>" aria-expanded="false">
                             <span>
                                 <i class="bi bi-disc fs-6"></i>
                             </span>
                             <span class="hide-menu">Features</span>
                         </a>
                     </li>
                 <?php } ?> -->
                 <?php if ($_SESSION[SESS . 'session_admin_users_level'] == 'employee') { ?>
                     <li class="sidebar-item">
                         <a class="sidebar-link" href="<?= PROJECT_PATH . 'src/html/profile/'; ?>" aria-expanded="false">
                             <span>
                                 <i class="bi bi-person-circle fs-6"></i>
                             </span>
                             <span class="hide-menu">Profile</span>
                         </a>
                     </li>
                 <?php } ?>
                 <?php if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin' || $_SESSION[SESS . 'session_admin_users_level'] == 'company' || $_SESSION[SESS . 'session_admin_users_level'] == 'branch' || $_SESSION[SESS . 'session_admin_users_level'] == 'employee') { ?>
                     <li class="nav-small-cap">
                         <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                         <span class="hide-menu">Reports</span>
                     </li>
                     <li class="sidebar-item">
                         <a class="sidebar-link" href="<?= PROJECT_PATH . 'src/html/attendance-report/'; ?>" aria-expanded="false">
                             <span>
                                 <i class="ti ti-article"></i>
                             </span>
                             <span class="hide-menu">Attendance Report</span>
                         </a>
                     </li>
                 <?php } ?>
                 <?php if ($_SESSION[SESS . 'session_admin_users_level'] == 'employee') { ?>
                     <li class="nav-small-cap">
                         <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                         <span class="hide-menu">Others</span>
                     </li>
                     <li class="sidebar-item">
                         <a class="sidebar-link" href="<?= PROJECT_PATH . 'src/html/change-password/'; ?>" aria-expanded="false">
                             <span>
                                 <i class="bi bi-disc fs-6"></i>
                             </span>
                             <span class="hide-menu">Change Password</span>
                         </a>
                     </li>
                     <li class="sidebar-item">
                         <a class="sidebar-link" href="<?= PROJECT_PATH . 'logout.php'; ?>" aria-expanded="false">
                             <span>
                                 <i class="bi bi-box-arrow-right fs-6"></i>
                             </span>
                             <span class="hide-menu">Logout</span>
                         </a>
                     </li>
                 <?php } ?>

             </ul>

         </nav>
         <!-- End Sidebar navigation -->
     </div>
     <!-- End Sidebar scroll-->
 </aside>
 <!--  Sidebar End -->