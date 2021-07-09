<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url()?>">
                <div class="sidebar-brand-icon">
                    <img class="sasuke-sidebar" src="<?= site_url('_/uploads/sites/'.$this->app->logo_app)?>" alt="<?= $this->app->judul_app_alt;?>">
                </div>
                <div class="sidebar-brand-text mr-5 position-relative"><?= $this->app->judul_app_alt;?></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <?php foreach ($this->menus as $menu) :?>

            <!-- Heading -->
            <div class="sidebar-heading">
                <?= $menu->label_menu;?>
            </div>

            <?php
            $submenus = $this->app_m->getSubMenu($menu->id_menu);
            if(!empty($submenus)):
                foreach ($submenus as $submenu):?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url($submenu->link_menu);?>">
                        <i class="<?= $submenu->icon_menu;?>"></i>
                        <span><?= $submenu->label_menu;?></span></a>
                </li>
            <?php endforeach; endif; ?>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <?php endforeach;?>

            <!-- Divider -->
            <!-- <hr class="sidebar-divider d-none d-md-block"> -->

            <!-- Heading -->
            <div class="sidebar-heading">
                AKUN
            </div>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('logout');?>" title="Logout"><i class="fas fa-fw fa-sign-out-alt"></i><span>Keluar</span></a>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->