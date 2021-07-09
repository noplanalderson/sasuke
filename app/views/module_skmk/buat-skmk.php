<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Buat Surat Kematian</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Form Surat Kematian</h6>
                        </div>
                        <div class="card-body">
                            <?= form_open('submit-skmk', 'method="post" id="formSkmk"');?>

                            <div class="row">
                                <div class="col-md-2">
                                    <label for="nomor">Nomor Surat *</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" id="nomor" class="form-control" name="nomor" value="<?= sprintf("%03d", $nomor);?>" required="required">
                                </div>

                                <div class="col-md-7">
                                    <input type="text" id="no_skmk" class="form-control" name="no_skmk" readonly="readonly" value="SKMK-<?= $this->instansi->kode_instansi ?>/<?= indonesian_month(date('Y-m-d'), 'ROME');?>/<?= date('Y');?>">
                                </div>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col-md-2">
                                    <label for="nama_pelapor">Nama Pelapor *</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" id="nama_pelapor" class="form-control" name="nama_pelapor" placeholder="Nama Pelapor" required="required">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-2">
                                    <label for="tempat_lahir_pelapor">Tempat/Tgl Lahir Pelapor *</label>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" id="tempat_lahir_pelapor" class="form-control" placeholder="Tempat Lahir" name="tempat_lahir_pelapor" required="required">
                                </div>
                                <div class="col-md-5">
                                    <input type="date" id="tgl_lahir_pelapor" class="form-control" name="tgl_lahir_pelapor"required="required">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-2">
                                    <label for="pekerjaan_pelapor">Pekerjaan Pelapor *</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" id="pekerjaan_pelapor" class="form-control" name="pekerjaan_pelapor" placeholder="Pekerjaan Pelapor">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-2">
                                    <label for="alamat_pelapor">Alamat Pelapor *</label>
                                </div>
                                <div class="col-md-10">
                                    <textarea id="alamat_pelapor" name="alamat_pelapor" class="form-control" required="required"></textarea>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-2">
                                    <label for="no_ktp_pelapor">No. KTP Pelapor *</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" id="no_ktp_pelapor" class="form-control" name="no_ktp_pelapor" placeholder="0000000000000000" required="required">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-2">
                                    <label for="hubungan">Hubungan dengan Terlapor *</label>
                                </div>
                                <div class="col-md-10">
                                    <select id="hubungan" class="form-control" name="hubungan" required="required">
                                        <option value="">Pilih Hubungan</option>
                                        <option value="ISTRI">ISTRI</option>
                                        <option value="SUAMI">SUAMI</option>
                                        <option value="IBU">IBU</option>
                                        <option value="AYAH">AYAH</option>
                                        <option value="NENEK">NENEK</option>
                                        <option value="KAKEK">KAKEK</option>
                                        <option value="ANAK">ANAK</option>
                                        <option value="KAKAK">KAKAK</option>
                                        <option value="ADIK">ADIK</option>
                                        <option value="SEPUPU">SEPUPU</option>
                                        <option value="PAMAN">PAMAN</option>
                                        <option value="BIBI">BIBI</option>
                                        <option value="LAINNYA">LAINNYA</option>
                                    </select>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            
                            <div class="row mt-3">
                                <div class="col-md-2">
                                    <label for="nama_terlapor">Nama Terlapor *</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" id="nama_terlapor" class="form-control" name="nama_terlapor" placeholder="Nama Terlapor" required="required">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-2">
                                    <label for="tempat_lahir_terlapor">Tempat/Tgl Lahir Terlapor *</label>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" id="tempat_lahir_terlapor" class="form-control" name="tempat_lahir_terlapor" placeholder="Tempat Lahir" required="required">
                                </div>
                                <div class="col-md-5">
                                    <input type="date" id="tgl_lahir_terlapor" class="form-control" name="tgl_lahir_terlapor" required="required">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-2">
                                    <label for="pekerjaan_terlapor">Pekerjaan Terlapor *</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" id="pekerjaan_terlapor" class="form-control" name="pekerjaan_terlapor" placeholder="Pekerjaan">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-2">
                                    <label for="alamat_terlapor">Alamat Terlapor *</label>
                                </div>
                                <div class="col-md-10">
                                    <textarea id="alamat_terlapor" name="alamat_terlapor" class="form-control" required="required"></textarea>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-2">
                                    <label for="no_ktp_terlapor">No. KTP Terlapor *</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" id="no_ktp_terlapor" class="form-control" name="no_ktp_terlapor" placeholder="0000000000000000" required="required">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-2">
                                    <label for="tgl_meninggal">Jam & Tanggal Meninggal *</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" id="tgl_meninggal" class="form-control" name="tgl_meninggal" required="required">
                                </div>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col-md-2">
                                    <label for="lokasi_meninggal">Lokasi Meninggal *</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" id="lokasi_meninggal" class="form-control" name="lokasi_meninggal" placeholder="Lokasi Meninggal" required="required">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-2">
                                    <label for="id_user">Penanda Tangan *</label>
                                </div>
                                <div class="col-md-10">
                                    <select id="id_user" class="form-control" name="id_user" required="required">
                                        <option value="">Pilih Pegawai</option>
                                        <?php foreach ($pegawai as $peg) :?>
                                            <option value="<?= $peg->id_user ?>"><?= $peg->nama_pegawai ?> - <?= $peg->user_type ?></option>
                                        
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-2">
                                    <label for="tembusan">Tembusan (Pisahkan dengan Koma)</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" id="tembusan" class="form-control" name="tembusan">
                                </div>
                            </div>

                            <div class="text-right">
                                <input type="reset" class="my-3 btn btn-small btn-primary" value="Reset">
                                
                                <input id="submit" type="submit" class="my-3 btn btn-small btn-success" name="submit" value="Submit">
                            </div>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->