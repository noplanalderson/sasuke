<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Pengaturan Instansi</h1>

                    <div id="message" class="alert d-none">
                        <small class="message">
                        </small>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Pengaturan</h6>
                        </div>
                        <div class="card-body">
                            <?= form_open_multipart('submit-instansi', 'method="post" id="formSetting" accept-charset="utf-8"');?>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Kode Instansi</label>
                                            <input type="text" id="kode_instansi" name="kode_instansi" placeholder="Kode Instansi" class="form-control" value="<?= $this->instansi->kode_instansi;?>" required="required"/>
                                            <small class="text-danger">Hanya huruf 2-10 karakter.</small>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Nama Instansi</label>
                                            <input type="text" id="nama_instansi" name="nama_instansi" placeholder="Nama Instansi" class="form-control" value="<?= $this->instansi->nama_instansi;?>" required="required" />
                                            <small class="text-danger">Hanya alfanumerik, spasi, dan dash</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama Instansi (alt)</label>
                                            <input type="text" id="nama_instansi_alt" name="nama_instansi_alt" placeholder="Nama Instansi (alt)" class="form-control" value="<?= $this->instansi->nama_instansi_alt;?>" />
                                            <small class="text-danger">Hanya alfanumerik, spasi, dan dash</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Induk Instansi</label>
                                            <input type="text" id="induk_instansi" name="induk_instansi" placeholder="Induk Instansi" class="form-control" value="<?= $this->instansi->induk_instansi;?>" required="required"/>
                                            <small class="text-danger">Hanya alfanumerik dan spasi</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kota Instansi</label>
                                            <input type="text" id="kota_instansi" name="kota_instansi" placeholder="Kota Instansi" class="form-control" value="<?= $this->instansi->kota_instansi;?>" required="required"/>
                                            <small class="text-danger">Hanya huruf dan spasi</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kota Administrasi/DATI II</label>
                                            <input type="text" id="kota_administrasi" name="kota_administrasi" placeholder="Kota Adminstrasi / DATI II" class="form-control" value="<?= $this->instansi->kota_administrasi;?>" required="required"/>
                                            <small class="text-danger">Hanya alfanumerik dan spasi</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Alamat Instansi</label>
                                            <textarea name="alamat_instansi" id="alamat_instansi" class="form-control"><?= $this->instansi->alamat_instansi;?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kode Pos Instansi</label>
                                            <input type="number" id="kode_pos_instansi" name="kode_pos_instansi" placeholder="Kode Pos" class="form-control" value="<?= $this->instansi->kode_pos_instansi;?>" required="required"/>
                                            <small class="text-danger">Hanya angka 5 karakter</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Telepon Instansi</label>
                                            <input type="text" id="telp_instansi" name="telp_instansi" placeholder="No. Telepon" class="form-control" value="<?= $this->instansi->telp_instansi;?>" required="required"/>
                                            <small class="text-danger">Format +62xxx / (021) xxx / 021-xxx-xxx </small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email Instansi</label>
                                            <input type="email" id="email_instansi" name="email_instansi" placeholder="Email" class="form-control" value="<?= $this->instansi->email_instansi;?>" required="required"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kop Instansi</label>
                                            <input type="hidden" name="kop_instansi" value="<?= $this->instansi->logo_kop_instansi;?>">
                                            <input type="file" class="form-control" name="kop_instansi" id=kop_instansi accept="image/*">
                                            <small class="text-danger">Ekstensi gambar harus JPG, JPEG, PNG maks. 5MB.</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <button type="reset" class="btn btn-small mt-3">Reset</button>
                                <button type="submit" id="submit" class="btn btn-small btn-primary mt-3" name="submit">Submit</button>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->