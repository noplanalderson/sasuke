<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Pengaturan Aplikasi</h1>

                    <div id="message" class="alert d-none">
                        <small class="message"></small>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Pengaturan</h6>
                        </div>
                        <div class="card-body">
                            <?= form_open_multipart('submit-setting', 'id="formSetting" method="post" data-parsley-validate');?>
                            
                            <label for="judul_app">Judul Aplikasi</label>
                            <input type="text" id="judul_app" 
                                name="judul_app" class="form-control" 
                                placeholder="Judul App" data-parsley-pattern="^[A-Za-z0-9 \-_]{5,255}$" 
                                value="<?= $this->app->judul_app ?>" 
                                required="required">
                            
                            <label for="judul_app_alt">Judul Aplikasi (alt)</label>
                            <input type="text" id="judul_app" 
                                name="judul_app_alt" class="form-control" 
                                placeholder="Judul App (alt)" data-parsley-pattern="^[A-Za-z0-9 \-_]{5,80}$" 
                                value="<?= $this->app->judul_app_alt ?>" 
                                required="required">

                            <label for="text_footer_app">Teks Footer</label>
                            <input type="text" id="judul_app" 
                                name="text_footer_app" class="form-control" 
                                placeholder="Teks Footer" data-parsley-pattern="^[A-Za-z0-9 @&();\-_.]{5,100}$" 
                                value="<?= $this->app->text_footer_app ?>" 
                                required="required">

                            <label for="logo_app">Logo Aplikasi</label>
                            <input type="hidden" name="logo_app" value="<?= $this->app->logo_app ?>">
                            <input type="file" class="form-control" name="logo_app">

                            <label for="icon_app">Icon Aplikasi</label>
                            <input type="hidden" name="icon_app" value="<?= $this->app->icon_app;?>">
                            <input type="file" class="form-control" name="icon_app">

                            <input type="submit" class="my-3 btn btn-small btn-success" name="submit" value="Submit">
                            
                            <input type="reset" class="my-3 btn btn-small btn-primary" value="Reset">
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->