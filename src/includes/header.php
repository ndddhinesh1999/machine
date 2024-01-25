<?php
$show_iage = show_iage();
?>
<!--  Header Start -->
<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
        </ul>
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                <li><b><?= $_SESSION[SESS . 'session_admin_users_title'] ?></b>&emsp;</li>
                <li class="nav-item dropdown">
                    <div class="message-body">
                        <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="<?= ($_SESSION[SESS . 'session_admin_users_level'] != 'employee') ? 'dropdown' : '' ?>" aria-expanded="false">
                            <?php if (!empty($show_iage['admin_users_image'])) { ?>
                                <img src="../<?= $show_iage['admin_users_image'] ?>" alt="" width="35" height="35" class="rounded-circle">
                            <?php } else { ?>
                                <i class="ti ti-user"></i>
                            <?php  } ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                            <div class="message-body">
                                <a href="<?= PROJECT_PATH . 'src/html/profile/'; ?>" class="d-flex align-items-center gap-2 dropdown-item">
                                    <i class="ti ti-user fs-6"></i>
                                    <p class="mb-0 fs-3">My Profile</p>
                                </a>
                                <a href="<?= PROJECT_PATH . 'src/html/change-password/'; ?>" class="d-flex align-items-center gap-2 dropdown-item">
                                    <i class="bi bi-disc fs-6"></i>
                                    <p class="mb-0 fs-3">Change Password</p>
                                </a>
                                <a href="<?= PROJECT_PATH . 'logout.php'; ?>" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                            </div>
                        </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!--  Header End -->