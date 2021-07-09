<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Manajemen User</h1>

                    <div id="delete_msg" class="alert d-none">
                        <small class="delete_msg"></small>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-md-10 col-sm-8 col-xs-12">
                                    <h6 class="m-0 font-weight-bold text-primary">Daftar User</h6>
                                </div>
                                <div class="col-md-2 col-sm-4 col-xs-12">
                                    <?= button($btn_add, TRUE, 'button', 'class="btn btn-sm tambah-user btn-primary" data-toggle="modal" data-target="#userModal"');?>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered w-100" id="tblUser">
                                    <thead>
                                        <tr>
                                            <th>Nama Pegawai</th>
                                            <th>NIP</th>
                                            <th>Username</th>
                                            <th>Tipe User</th>
                                            <th>Email</th>
                                            <th>Aktif</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($users as $user) :?>
                                        <tr>
                                            <td><?= $user->nama_pegawai ?></td>
                                            <td><?= $user->nip ?></td>
                                            <td><?= $user->user_name ?></td>
                                            <td><?= $user->user_type ?></td>
                                            <td><?= $user->user_email ?></td>
                                            <td><?= $user->is_active ?></td>
                                            <td>
                                                <?= button($btn_edit, FALSE, 'button', 'data-id="'.encrypt($user->id_user).'" class="btn btn-sm btn-warning edit-user" data-toggle="modal" data-target="#userModal"');?>

                                                <?= button($btn_del, FALSE, 'button', 'data-id="'.encrypt($user->id_user).'" class="btn btn-sm btn-danger delete-btn"');?>
                                            </td>
                                        </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

                <!-- Tambah User Modal-->
                <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="User"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"></h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div id="msg" class="alert d-none">
                                    <small class="msg"></small>
                                </div>

                                <?= form_open('', 'method="post" id="userForm" accept-charset="utf-8"');?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="hidden" name="id_user" id="id_user" value="">
                                        <div class="form-group">
                                            <label for="user_name">Username *</label>
                                            <input type="text" id="user_name" name="user_name" class="form-control" placeholder="Username" data-parsley-pattern="^[A-Za-z0-9_]{1,15}$" required="required">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="user_email">Email *</label>
                                            <input type="email" id="user_email" name="user_email" class="form-control" placeholder="Email User" required="required">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Nama Pegawai *</label>
                                        <input type="text" id="nama_pegawai" name="nama_pegawai" placeholder="Nama Pegawai" class="form-control" required="required"/>
                                        <small class="text-danger">Hanya Huruf, titik, koma, dan Spasi</small>
                                    </div>
                                    <div class="col-md-6">
                                        <label>NIP</label>
                                        <input type="text" id="nip" name="nip" placeholder="NIP" class="form-control" />
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="id_type">Tipe User/Jabatan *</label>
                                            <select id="id_type" class="form-control" name="id_type" required="required">
                                                <option value="">Pilih Tipe User</option>
                                                <?php foreach ($user_type as $type) :?>

                                                    <option value="<?= $type->id_type ?>"><?= $type->user_type ?></option>
                                                
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="is_active_box" class="col-md-6">
                                        <input class="my-3" id="is_active" type="checkbox" name="is_active" value="TRUE"><label for="is_active" class="ml-1">Aktivasi User</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="reset" data-dismiss="modal">Reset</button>
                                <input type="submit" id="submitUser" class="my-3 btn btn-small btn-success" name="submit" value="Submit">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>