<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>

<body class="bg-gradient-primary">
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <img class="logo-sasuke" src="<?= site_url('assets/uploads/'.$this->site['logo_app']);?>">
                                    <div class="text-center mb-4">
                                        <h1 class="h4 text-gray-900"><?= $this->site['judul_app_alt'];?></h1>
                                        <small><?= $this->site['judul_app'];?> <?= SASUKE_VERSION ?></small>
                                    </div>
                                    <div id="msg_login" class="alert" style="display:none;">
                                        <small class="msg_login"></small>
                                    </div>
                                    <?= form_open('login/auth', 'method="post" id="formLogin" class="user" data-parsley-validate accept-charset=utf-8');?>
                                        <div class="form-group">
                                            <input id="user_name" type="text" name="username" class="form-control form-control-user" pattern="^[A-Za-z0-9_]{3,20}$" placeholder="Username" value="<?= set_value('username');?>" required />
                                            <?= form_error('username','<small class="text-danger pl-3">','</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <div class="wrapper">
                                                <input id="user_password" type="password" name="password" class="form-control form-control-user" placeholder="Password" required autocomplete="off" />
                                                <?= form_error('password','<small class="text-danger pl-3">','</small>'); ?>
                                                <span class="show-btn-password" style="top:40%;"><i class="fa fa-eye"></i></span>
                                            </div>
                                        </div>
                                        <button id="submitLogin" type="submit" name="login" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('lupa-password');?>">Lupa Password?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>