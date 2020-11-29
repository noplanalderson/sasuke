<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Daftar Jabatan</h1>

                    <?= $this->session->flashdata('message');?>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-md-10">
                                    <h6 class="m-0 font-weight-bold text-primary">Daftar Jabatan</h6>
                                </div>
                                <div class="col-md-2">
                                    <?= button($btn_add, TRUE, 'a', 'href="#" class="btn btn-small tambah-jabatan btn-primary" data-toggle="modal" data-target="#jabatanModal"');?>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="800px">Nama Jabatan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($jabatan as $jbt) :?>
                                        <tr>
                                            <td><?= $jbt->nama_jabatan ?></td>
                                            <td>
                                                <?= button($btn_edit, FALSE, 'a', 'href="#" class="btn btn-small btn-warning edit-jabatan" data-toggle="modal" data-target="#jabatanModal" data-id="'.encrypt($jbt->id_jabatan).'"');?>
                                                <?= button($btn_del, FALSE, 'a', 'href="'.base_url($btn_del->link_menu).'/'.encrypt($jbt->id_jabatan).'" class="btn btn-small btn-danger" onclick="return confirm(\'Anda Yakin Ingin Menghapus Jabatan?\')"');?>
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

                <!-- Tambah Akses Modal-->
                <div class="modal fade" id="jabatanModal" tabindex="-1" role="dialog" aria-labelledby="Jabatan"
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
                                <div id="msg_jabatan" class="alert" style="display:none;">
                                    <small class="msg_jabatan"></small>
                                </div>

                                <?= form_open('', 'id="jabatanForm" method="post" data-parsley-validate');?>

                                <input type="hidden" id="id_jabatan" name="id_jabatan" value="">

                                <label for="nama_jabatan">Nama Jabatan</label>
                                <?= form_input('nama_jabatan', '', 'id="nama_jabatan" placeholder="Nama Jabatan (Alfanumerik dan Spasi 2-255 karakter)" class="form-control" required="required" data-parsley-pattern="^[A-Za-z0-9 ]{2,255}$"');?>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="reset" data-dismiss="modal">Reset</button>
                                <button id="submit" class="btn btn-success" type="submit" name="submit"></button>
                                </form>
                        </button>
                        </div>
                    </div>
                </div>