<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Manajemen Akses</h1>

                    <!-- <div class="msg" style="display:none;"><?php // $this->session->flashdata('message');?></div> -->

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-md-10">
                                    <h6 class="m-0 font-weight-bold text-primary">Daftar Akses</h6>
                                </div>
                                <div class="col-md-2">
                                    <?= button($btn_add, TRUE, 'a', 'href="#" class="btn btn-small tambah-akses btn-primary" data-toggle="modal" data-target="#aksesModal"');?>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tipe Akses</th>
                                            <th width="700px">Roles</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($akses_list as $akses) :?>
                                        <tr>
                                            <td><?= $akses->user_type ?></td>
                                            <td><?= $this->akses_m->getRolesByID($akses->id_type); ?></td>
                                            <td>
                                                <?= button($btn_edit, FALSE, 'a', 'href="#" class="btn btn-small btn-warning edit-akses" data-toggle="modal" data-target="#aksesModal" data-id="'.encrypt($akses->id_type).'"');?>
                                                <?= button($btn_del, FALSE, 'a', 'href="'.base_url($btn_del->link_menu).'/'.encrypt($akses->id_type).'" class="btn btn-small btn-danger" onclick="return confirm(\'Anda Yakin Ingin Menghapus Tipe User?\')"');?>
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
                <div class="modal fade" id="aksesModal" tabindex="-1" role="dialog" aria-labelledby="Akses"
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
                                <div id="msg" class="alert" style="display:none;">
                                    <small class="msg"></small>
                                </div>

                                <?= form_open('', 'id="aksesForm" method="post" data-parsley-validate');?>

                                <input type="hidden" id="id_type" name="id_type" value="">

                                <label for="user_type">Tipe User</label>
                                <?= form_input('user_type', '', 'id="user_type" placeholder="Tipe Akses (Alfabet 1-15 karakter)" class="form-control" required="required" data-parsley-pattern="^[A-Za-z]{1,15}$"');?>

                                <label for="id_menu">Role</label>
                                <select id="id_menu" name="id_menu[]" class="form-control select2-no-search" required="required" multiple="multiple" style="width:100%">
                                    <?php foreach ($roles as $role) :?>
                                        <option value="<?= $role->id_menu ?>"><?= $role->label_menu ?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="reset" data-dismiss="modal">Reset</button>
                                <button id="submit" class="btn btn-success" type="submit" name="submit"></button>
                                </form>
                        </button>
                        </div>
                    </div>
                </div>