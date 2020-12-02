<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Manajemen User</h1>

                    <?= $this->session->flashdata('message');?>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-md-10">
                                    <h6 class="m-0 font-weight-bold text-primary">Daftar User</h6>
                                </div>
                                <div class="col-md-2">
                                    <?= button($btn_add, TRUE, 'a', 'href="'.base_url($btn_add->link_menu).'" class="btn btn-small btn-primary"');?>
                                    <!-- <button href="<?= base_url('tambah-user');?>" class="btn btn-small btn-primary">Tambah User</button> -->
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="tblUser" width="100%" cellspacing="0">
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
                                                <?= button($btn_edit, FALSE, 'a', 'href="'.base_url($btn_edit->link_menu).'/'.encrypt($user->id_user).'" class="btn btn-sm btn-warning"');?>

                                                <?= button($btn_del, FALSE, 'a', 'href="'.base_url($btn_del->link_menu).'/'.encrypt($user->id_user).'" class="btn btn-sm btn-danger" onclick="return confirm(\'Anda Yakin Ingin Menghapus User?\')"');?>

                                                <?php $action = ($user->is_active == TRUE) ? 'deaktivasi' : 'aktivasi';?>

                                                <?= button($btn_status, FALSE, 'a', 'href="'.base_url($btn_status->link_menu).'/'.$action.'/'.encrypt($user->id_user).'" class="btn btn-sm btn-secondary" onclick="return confirm(\'Anda Yakin Ingin '.$action.' User?\')"');?>
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