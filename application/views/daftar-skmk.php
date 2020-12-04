<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Surat Kematian</h1>

                    <?= $this->session->flashdata('message');?>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar SKMK</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tabelSkmk" class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No. Surat</th>
                                            <th>Nama Pelapor</th>
                                            <th>Nama Terlapor</th>
                                            <th>Tanggal Meninggal</th>
                                            <th>Penanda Tangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($skmk_list as $skmk) :?>
                                        <tr>
                                            <td><?= $skmk->no_skmk ?></td>
                                            <td><?= $skmk->nama_pelapor ?></td>
                                            <td><?= $skmk->nama_terlapor ?></td>
                                            <td><?= $skmk->tgl_meninggal ?></td>
                                            <td><?= $skmk->nama_pegawai ?></td>
                                            <td>
                                                <?= button($btn_detail, FALSE, 'a', '" class="btn btn-small btn-primary" target="_blank"', encrypt($skmk->no_skmk));?>
                                                <?= button($btn_edit, FALSE, 'a', '" class="btn btn-small btn-warning"', encrypt($skmk->no_skmk));?>
                                                <?= button($btn_del, FALSE, 'a', '" class="btn btn-small btn-danger" onclick="return confirm(\'Anda Yakin Ingin Menghapus SKMK?\')"', encrypt($skmk->no_skmk));?>
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