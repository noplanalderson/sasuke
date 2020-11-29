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
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Tipe User</th>
                                            <th>Email</th>
                                            <th>Aktif</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    if(!empty($users))
                                    {
                                        foreach ($users as $user) :?>
                                        <tr>
                                            <td><?= $user->user_name ?></td>
                                            <td><?= $user->user_type ?></td>
                                            <td><?= $user->user_email ?></td>
                                            <td><?= $user->is_active ?></td>
                                            <td>
                                                <?= button($btn_edit, FALSE, 'a', 'href="'.base_url($btn_edit->link_menu).'/'.encrypt($user->id_user).'" class="btn btn-small btn-warning"');?>
                                                <?= button($btn_del, FALSE, 'a', 'href="'.base_url($btn_del->link_menu).'/'.encrypt($user->id_user).'" class="btn btn-small btn-danger" onclick="return confirm(\'Anda Yakin Ingin Menghapus User?\')"');?>
                                            </td>
                                        </tr>
                                        <?php endforeach;
                                    }
                                    else
                                    {
                                        echo '<tr class="text-center"><td colspan="5">Tidak ada Data</td></tr>';
                                    }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->