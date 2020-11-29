<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Daftar Pejabat</h1>

                    <?= $this->session->flashdata('message');?>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-md-10">
                                    <h6 class="m-0 font-weight-bold text-primary">Daftar Pejabat</h6>
                                </div>
                                <div class="col-md-2">
                                    <?= button($btn_add, TRUE, 'a', 'href="#" class="btn btn-small tambah-pejabat btn-primary" data-toggle="modal" data-target="#pejabatModal"');?>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>NIP</th>
                                            <th>Nama Pejabat</th>
                                            <th>Jabatan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($pejabat as $pjb) :?>
                                        <tr>
                                            <td><?= $pjb->nip ?></td>
                                            <td><?= $pjb->nama_pejabat ?></td>
                                            <td><?= $pjb->nama_jabatan ?></td>
                                            <td>
                                                <?= button($btn_edit, FALSE, 'a', 'href="#" class="btn btn-small btn-warning edit-pejabat" data-toggle="modal" data-target="#pejabatModal" data-id="'.encrypt($pjb->id_pejabat).'"');?>
                                                <?= button($btn_del, FALSE, 'a', 'href="'.base_url($btn_del->link_menu).'/'.encrypt($pjb->id_pejabat).'" class="btn btn-small btn-danger" onclick="return confirm(\'Anda Yakin Ingin Menghapus Pejabat?\')"');?>
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
                <div class="modal fade" id="pejabatModal" tabindex="-1" role="dialog" aria-labelledby="Pejabat"
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
                                <div id="msg_pejabat" class="alert" style="display:none;">
                                    <small class="msg_pejabat"></small>
                                </div>

                                <?= form_open('', 'id="pejabatForm" method="post" data-parsley-validate');?>

                                <input type="hidden" id="id_pejabat" name="id_pejabat" value="">

                                <label for="nip">NIP</label>
                                <?= form_input('nip', '', 'id="nip" placeholder="Nama Pejabat (Numerik 18 karakter)" class="form-control" required="required" pattern="^[0-9]{18}$"');?>

                                <label for="id_jabatan">Jabatan</label>
                                <select id="id_jabatan" name="id_jabatan" class="form-control" required="required">
                                    <option value="">Pilih Jabatan</option>
                                    <?php foreach ($jabatan as $jbt) :?>
                                    <option value="<?= $jbt->id_jabatan ?>"><?= $jbt->nama_jabatan ?></option>
                                    <?php endforeach; ?>
                                    option
                                </select>
                                
                                <label for="nama_pejabat">Nama Pejabat</label>
                                <?= form_input('nama_pejabat', '', 'id="nama_pejabat" placeholder="Nama Pejabat (Alfabet dan Spasi 2-255 karakter)" class="form-control" required="required" pattern="^[A-Za-z ]{2,255}$"');?>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="reset" data-dismiss="modal">Reset</button>
                                <button id="submit" class="btn btn-success" type="submit" name="submit"></button>
                                </form>
                        </button>
                        </div>
                    </div>
                </div>