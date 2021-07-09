<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Surat Kematian</h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-md-8">
                                    <h6 class="m-0 font-weight-bold text-primary">Cetak Surat Kematian</h6>
                                    <small id="no-surat"><?= str_replace('/', '-', $skmk->no_skmk) ?></small>
                                </div>
                                <div class="col-md-4">
                                    <button title="Print" class="btn btn-success export-pdf export-btn"><i class="fa fa-download"></i> Ekspor ke PDF</button>
                                    <button title="Print" class="btn btn-info cetak-surat export-btn"><i class="fa fa-print"></i> Cetak Surat</button>
                                </div>
                            </div>
                        </div>
                        <div id="cetak" class="card-body text-dark">
                            <div class="rem-5">
                                  <table class="table-skmk" width="100%" align="center">
                                  <!--FORM HEADER-->
                                      <tr class="text-center">
                                          <td colspan="2" class="align-middle"><img src="<?= encodeImage('./_/uploads/sites/'.$this->instansi->logo_kop_instansi);?>" width="150px" height="150px"></td>
                                          <td colspan="18" class="align-middle;">
                                            <h5><?= strtoupper($this->instansi->induk_instansi) ?></h5>
                                            <h4><?= strtoupper($this->instansi->nama_instansi) ?></h4>
                                            <p><?= $this->instansi->alamat_instansi.', Kode Pos : '.$this->instansi->kode_pos_instansi ?><br/>
                                            Telp : <?= $this->instansi->telp_instansi ?>, Email : <?= $this->instansi->email_instansi ?></p>
                                            <h5><?= strtoupper($this->instansi->kota_instansi) ?></h5>
                                          </td>
                                      </tr>
                                      <tr height="10px">
                                          <td colspan="15"><hr class="batas-kop"></td>
                                      </tr>
                                  </table>

                                  <h5 class="my-3 text-center text-decoration"><strong><u>KETERANGAN MELAPOR KEMATIAN (SKMK)</u></strong></h5>
                                  <p class="text-center">Nomor : <?= $skmk->no_skmk ?></p>

                                  <div class="mt-5 header-pelapor">
                                      <p>Yang bertanda tangan di bawah ini Kepala <?= ucwords(strtolower($this->instansi->nama_instansi)) ?> Kota Administrasi <?= $this->instansi->kota_administrasi ?> telah menerima laporan dari :</p>
                                  </div>

                                  <table class="table-lapor">
                                      <tr>
                                          <td width="200px">Nama</td>
                                          <td>: <?= $skmk->nama_pelapor ?></td>
                                      </tr>
                                      <tr>
                                          <td width="200px">Tempat/Tgl. Lahir</td>
                                          <td>: <?= $skmk->ttl_pelapor ?></td>
                                      </tr>
                                      <tr>
                                          <td width="200px">Pekerjaan</td>
                                          <td>: <?= $skmk->pekerjaan_pelapor ?></td>
                                      </tr>
                                      <tr>
                                          <td width="200px">Alamat</td>
                                          <td>: <?= $skmk->alamat_pelapor ?></td>
                                      </tr>
                                      <tr>
                                          <td width="200px">No. KTP</td>
                                          <td>: <?= $skmk->no_ktp_pelapor ?></td>
                                      </tr>
                                  </table>

                                  <div class="mt-3 indent-50">
                                      <p>Hubungan dengan Almarhum/ah : <?= $skmk->hubungan ?></p>
                                      <p>Atas kematian seseorang sebagai berikut :</p>
                                  </div>

                                  <table class="table-lapor">
                                      <tr>
                                          <td width="200px">Nama</td>
                                          <td>: <?= $skmk->nama_terlapor ?></td>
                                      </tr>
                                      <tr>
                                          <td width="200px">Tempat/Tgl. Lahir</td>
                                          <td>: <?= $skmk->ttl_terlapor ?></td>
                                      </tr>
                                      <tr>
                                          <td width="200px">Pekerjaan</td>
                                          <td>: <?= $skmk->pekerjaan_terlapor ?></td>
                                      </tr>
                                      <tr>
                                          <td width="200px">Alamat</td>
                                          <td>: <?= $skmk->alamat_terlapor ?></td>
                                      </tr>
                                      <tr>
                                          <td width="200px">No. KTP</td>
                                          <td>: <?= $skmk->no_ktp_terlapor ?></td>
                                      </tr>
                                      <tr>
                                          <td width="200px">Tgl. Meninggal Dunia</td>
                                          <td>: <?= $skmk->tgl_meninggal ?></td>
                                      </tr>
                                      <tr>
                                          <td width="200px">Waktu Meninggal</td>
                                          <td>: <?= $skmk->jam_meninggal ?></td>
                                      </tr>
                                      <tr>
                                          <td width="200px">Tempat Meninggal</td>
                                          <td>: <?= $skmk->lokasi_meninggal ?></td>
                                      </tr>
                                  </table>

                                  <div class="mt-3 header-pelapor">
                                      <p>Sehubungan Jenazah telah dimakamkan/di rumah duka, maka tidak dapat diterbitkan Surat Keterangan Penyebab Kematian (SKPK), maka sebagai pengganti diterbitkan Surat Keterangan Melapor Kematian (SKMK), berdasarkan surat keterangan dan kelengkapan administrasi lainnya yang diserahkan oleh pihak keluarga.</p>
                                      <p>Demikian surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.</p>
                                  </div>

                                  <div class="mt-5 tanda-tangan">
                                      <p><?= ucwords(strtolower($this->instansi->kota_instansi)) ?>, <?= indonesian_date($skmk->tgl_dibuat);?></p>
                                      <p class="mt-min-1">a.n. Kepala <?= ucwords(strtolower($this->instansi->nama_instansi_alt)) ?></p>
                                      <p class="mt-min-1"><?= ucwords(strtolower($this->instansi->kota_administrasi)) ?>,</p>
                                      <p class="mt-min-1"><?= $skmk->user_type ?></p>
                                      <p class="mt-5"><u><?= $skmk->nama_pegawai ?></u></p>
                                      <p class="mt-min-1">NIP. <?= $skmk->nip ?></p>
                                  </div>

                                  <div class="mt-3 mb-5 text-justify">
                                    <?php 
                                        if(!empty($skmk->tembusan)){
                                            $tembusan = explode(',', $skmk->tembusan);
                                            echo 'Kepada Yth.<br/>';
                                                echo '<ol>';

                                            for ($i=0; $i < count($tembusan); $i++) { 
                                                echo '<li>'.$tembusan[$i].'</li>';
                                            }
                                            echo '</ol>';
                                        }
                                    ?>
                                    <p>*) Coret yang tidak perlu</p>
                                  </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->