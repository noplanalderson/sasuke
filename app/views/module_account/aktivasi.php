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
                                    <img class="logo-sasuke" src="<?= site_url('_/uploads/sites/'.$this->app->logo_app);?>">
                                    <div class="text-center mb-4">
                                        <h1 class="h4 text-gray-900"><?= $this->app->judul_app_alt;?></h1>
                                        <small>Atur Password Anda</small>
                                    </div>
                                    <?= form_open('submit-password', 'method="post" id="formPassword" class="user" data-parsley-validate accept-charset="utf-8"');?>
                                        <input type="hidden" name="kode" id="kode" value="<?= $token ?>">
                                        <label for="user_password">Password</label>
                                        <div class="wrapper">
                                            <input id="user_password" 
                                                type="password" 
                                                class="form-control" 
                                                name="user_password" 
                                                data-parsley-pattern="^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[.!@$%?/~_]).{8,32}$"
                                                required="required">
                                                <span class="show-btn-password d-flex"><i class="fa fa-eye password"></i></span>
                                            <small class="text-danger">Password harus mengandung huruf besar, kecil, angka, dan simbol</small>
                                        </div>

                                        <label for="repeat_password my-2">Repeat Password</label>
                                        <div class="wrapper">
                                            <input id="repeat_password" 
                                                type="password" 
                                                class="form-control" 
                                                name="repeat_password" 
                                                data-parsley-equalto="#user_password">
                                            <span class="show-btn-repeat d-flex"><i class="fa fa-eye repeat"></i></span>
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                                            Submit
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('login');?>">Coba Login?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>