<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Manajemen User</h1>

                    <div id="msg_user" class="alert" style="display: none">
                        <small class="msg_user">
                        </small>
                    </div>
                    <?= $messages ?>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Taambah User</h6>
                        </div>
                        <div class="card-body">
                            <?= form_open_multipart('', 'method="post" id="Userman" accept-charset="utf-8"');?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_name">Username *</label>
                                        <input type="text" id="user_name" 
                                            name="user_name" class="form-control" 
                                            placeholder="Username" data-parsley-pattern="^[A-Za-z0-9_]{1,15}$" 
                                            value="<?= $form_value['user_name'];?>" 
                                            required="required">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_email">Email *</label>
                                        <input type="email" id="user_email" 
                                            name="user_email" class="form-control" 
                                            placeholder="Email User" 
                                            value="<?= $form_value['user_email'];?>" 
                                            required="required">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Nama Pegawai *</label>
                                    <input type="text" id="nama_pegawai" name="nama_pegawai" placeholder="Nama Pegawai" class="form-control" value="<?= $form_value['nama_pegawai'];?>" required="required"/>
                                    <small class="text-danger">Hanya Huruf, titik, koma, dan Spasi</small>
                                </div>
                                <div class="col-md-6">
                                    <label>NIP</label>
                                    <input type="text" id="nip" name="nip" placeholder="NIP" class="form-control" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="wrapper">
                                        <label for="user_password">Password</label>
                                        <input id="user_password" 
                                            type="password" 
                                            class="form-control" 
                                            name="user_password" 
                                            data-parsley-pattern="^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[.!@$%?/~_]).{8,32}$"
                                            required="required">
                                            <span class="show-btn-password" style="top:3.2rem;"><i class="fa fa-eye"></i></span>
                                        <small class="text-danger">Password harus mengandung huruf besar, kecil, angka, dan simbol</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wrapper">
                                        <label for="repeat_password my-2">Repeat Password *</label>
                                        <input id="repeat_password" 
                                            type="password" 
                                            class="form-control" 
                                            name="repeat_password" 
                                            data-parsley-equalto="#user_password" required="required">
                                        <span class="show-btn-repeat" style="top:3.2rem;"><i class="fa fa-eye"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_type">Tipe User/Jabatan *</label>
                                        <select id="id_type" class="form-control" name="id_type" required="required">
                                            <option value="">Pilih Tipe User</option>
                                            <?php foreach ($user_type as $type) :?>
                                                <option value="<?= $type->id_type ?>" 
                                                <?php if($form_value['id_type'] == $type->id_type) :?> selected="selected"<?php endif;?>>
                                                <?= $type->user_type ?>
                                                    
                                                </option>
                                            
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_picture">Foto User</label>
                                        <input id="user_picture" type="hidden" name="user_picture" value="<?= $form_value['user_picture'];?>">
                                        <input id="user_picture" type="file" class="form-control" name="user_picture">
                                    </div>
                                </div>
                            </div>

                            <input class="my-3" type="checkbox" 
                                name="is_active" value="TRUE" 
                                <?php if($form_value['is_active'] == $form_value['is_active']) :?> 
                                checked="checked"<?php endif;?>> 
                                <label for="user_picture">Aktivasi User</label>
                                <br/>
                            
                            <input type="submit" id="submitUser" class="my-3 btn btn-small btn-success" name="submit" value="Submit">
                            
                            <input type="reset" class="my-3 btn btn-small btn-primary" value="Reset">
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->