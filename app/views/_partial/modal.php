<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin Ingin Keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Klik "Keluar" untuk keluar dari Aplikasi.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" href="<?= base_url('logout')?>">Keluar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Password Modal-->
    <div class="modal fade" id="gantiPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ganti Password?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="msg_pwd" class="alert d-none">
                        <small class="msg_pwd"></small>
                    </div>

                    <?= form_open('ganti-password', 'id="formPassword" method="post" data-parsley-validate');?>
                    <label for="user_password">Password</label>
                    <div class="wrapper">
                        <input id="user_password" 
                            type="password" 
                            class="form-control" 
                            placeholder="********"
                            name="user_password" 
                            data-parsley-pattern="^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[.!@$%?/~_]).{8,32}$"
                            required="required">
                            <span class="show-btn-password"><i class="fa fa-eye"></i></span>
                        <small class="text-danger">Password harus mengandung huruf besar, kecil, angka, dan simbol</small>
                    </div>

                    <label for="repeat_password my-2">Repeat Password</label>
                    <div class="wrapper">
                        <input id="repeat_password" 
                            type="password" 
                            class="form-control" 
                            placeholder="********"
                            name="repeat_password" 
                            data-parsley-equalto="#user_password">
                        <span class="show-btn-repeat"><i class="fa fa-eye"></i></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <input id="submitPassword" type="submit" class="btn btn-small btn-primary" name="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="akunModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pengaturan Akun</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="msg_akun" class="alert d-none">
                        <small class="msg_akun"></small>
                    </div>

                    <?= form_open_multipart('akun', 'id="formAkun" method="post"');?>
                    <label for="user_name">Username</label>
                    <input id="user_name" type="text" class="form-control" name="user_name" placeholder="Username (ex: user_name)" required="required">

                    <label for="user_email">Email</label>
                    <input id="user_email" type="email"  class="form-control" name="user_email" placeholder="kamu@dimana.domain" required="required">

                    <input id="user_picture_old" type="hidden" name="user_picture_old">

                    <label for="user_picture">Foto Profil</label>
                    <input id="user_picture" type="file" class="form-control" name="user_picture">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <input id="submitAkun" type="submit" class="btn btn-small btn-primary" name="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>