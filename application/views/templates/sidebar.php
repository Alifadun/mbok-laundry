<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-hot-tub"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Mbok Laundry</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider ">

    <?php
    $role_id = $this->session->userdata('role_id');
    ?>

    <?php if ($role_id == 1) : ?>

        <div class="sidebar-heading">admin</div>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin'); ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin/catatlaundry'); ?>">
                <i class="fas fa-fw fa-pen"></i>
                <span>Catatan Laundry</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin/pesan'); ?>">
                <i class="fas fa-envelope-square"></i>
                <span>tambahPesan</span></a>
        </li>

        <!-- <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/hargalaundry'); ?>">
            <i class="fas fa-fw fa-clipboard"></i>
            <span>Harga laundry</span></a>
    </li> -->
    <?php else : ?>
    <?php endif; ?>
    
    
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('user'); ?>">
            <i class="fas fa-fw fa-user-edit"></i>
            <span>Profil saya</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('user/datalaundry'); ?>">
            <i class="fas fa-fw fa-book-open"></i>
            <span>Data laundry</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('user/changepassword'); ?>">
            <i class="fas fa-fw fa-key"></i>
            <span>Change password</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('user/pesan'); ?>">
            <i class="fas fa-envelope-square"></i>
            <span>tambahPesan</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>
    <!-- QUERY MENU -->
    <!-- ?php
    $role_id = $this->session->userdata('role_id');
    $queryMenu =    "SELECT `user_menu`.`id`, `menu`
                         FROM `user_menu` JOIN `user_access_menu` 
                            ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                        WHERE `user_access_menu`.`role_id` = $role_id
                    ORDER BY `user_access_menu`.`menu_id` ASC    
                        ";
    $menu = $this->db->query($queryMenu)->result_array();
    ?>

    LOOPING MENU
    php foreach ($menu as $m) : ?>
        <div class="sidebar-heading">
            <= $m['menu']; ?>
        </div>


         SIAPKAN SUB-MENU SESUAI MENU
        ?php
        $menuId = $m['id'];
        $querySubMenu = "SELECT *
                            FROM `user_sub_menu` JOIN `user_menu` 
                            ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                        WHERE `user_sub_menu`.`menu_id` = $menuId
                            AND `user_sub_menu`.`is_active` = 1
                        ";
        $subMenu = $this->db->query($querySubMenu)->result_array();
        ?>

        < foreach ($subMenu as $sm) : ?>
            < if ($title == $sm['title']) : ?>
                <li class="nav-item active">
                < else : ?>
                <li class="nav-item">
                <php endif; ?>
                <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
                    <i class="<?= $sm['icon']; ?>"></i>
                    <span><?= $sm['title']; ?></span></a>
                </li>
            < endforeach; ?>

            <hr class="sidebar-divider mt-3">

        php endforeach; ?> -->



    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->