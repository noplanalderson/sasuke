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
                                        <small>Masukkan email anda</small>
                                    </div>
                                    <?= form_open('do-reset', 'method="post" id="formLupa" class="user" data-parsley-validate accept-charset="utf-8"');?>
                                        <div class="form-group">
                                            <input id="user_email" type="email" name="user_email" class="form-control form-control-user" placeholder="Email" value="" required />
                                        </div>
                                        <button id="submitLupa" type="submit" name="submit" class="btn btn-primary btn-user btn-block">
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