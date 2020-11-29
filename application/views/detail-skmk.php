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
                                </div>
                                <div class="col-md-4">
                                    <button title="Print" onclick="eksporPDF()" class="btn btn-success" style="margin-right:15px;border-radius:5px;float:right;"><i class="fa fa-download"></i> Ekspor ke PDF</button>
                                    <button title="Print" onclick="cetakSurat()" class="btn btn-info" style="margin-right:15px;border-radius:5px;float:right;"><i class="fa fa-print"></i> Cetak Surat</button>
                                </div>
                            </div>
                        </div>
                        <div id="cetak" class="card-body">
                            <div class="table-responsive" style="width:80%;margin-left:10%">
                                  <table class="" style="font-family:Calibri, sans-serif; border-collapse: collapse;" width="100%" align="center">
                                  <!--FORM HEADER-->
                                      <tr style="text-align:center;">
                                          <td colspan="2" style="vertical-align:middle;"><img src="<?= encodeImage('./assets/uploads/'.$instansi->logo_kop_instansi);?>" width="150px" height="150px"></td>
                                          <td colspan="18" style="vertical-align:middle;">
                                            <h5><?= strtoupper($instansi->induk_instansi) ?></h5>
                                            <h5>DINAS KESEHATAN</h5>
                                            <h4><?= strtoupper($instansi->nama_instansi) ?></h4>
                                            <p><?= $instansi->alamat_instansi.', Kode Pos : '.$instansi->kode_pos_instansi ?><br/>
                                            Telp : <?= $instansi->telp_instansi ?>, Email : <?= $instansi->email_instansi ?></p>
                                            <h5><?= strtoupper($instansi->kota_instansi) ?></h5>
                                          </td>
                                      </tr>
                                      <tr height="10px" style="font-size:7px;">
                                          <td colspan="15"><hr class="batas-kop"></td>
                                      </tr>
                                  </table>

                                  <h5 class="my-3 text-center text-decoration"><strong><u>KETERANGAN MELAPOR KEMATIAN (SKMK)</u></strong></h5>
                                  <p class="text-center">Nomor : <?= $skmk->no_skmk ?></p>

                                  <div class="mt-5" style="text-indent:50px;text-align: justify">
                                      <p>Yang bertanda tangan di bawah ini Kepala <?= ucwords(strtolower($instansi->nama_instansi)) ?> Kota Administrasi <?= $instansi->kota_administrasi ?> telah menerima laporan dari :</p>
                                  </div>

                                  <table style="border:none;width:80%;margin-left:10%">
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

                                  <div class="mt-3" style="text-indent:50px;">
                                      <p>Hubungan dengan Almarhum/ah : <?= $skmk->hubungan ?></p>
                                      <p>Atas kematian seseorang sebagai berikut :</p>
                                  </div>

                                  <table style="border:none;width:80%;margin-left:10%">
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

                                  <div class="mt-3" style="text-indent:50px;text-align: justify">
                                      <p>Sehubungan Jenazah telah dimakamkan/di rumah duka, maka tidak dapat diterbitkan Surat Keterangan Penyebab Kematian (SKPK), maka sebagai pengganti diterbitkan Surat Keterangan Melapor Kematian (SKMK), berdasarkan surat keterangan dan kelengkapan administrasi lainnya yang diserahkan oleh pihak keluarga.</p>
                                      <p>Demikian surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.</p>
                                  </div>

                                  <div class="mt-5" style="text-indent:60%;">
                                      <p><?= ucwords(strtolower($instansi->kota_instansi)) ?>, <?= format_tanggal($skmk->tgl_dibuat);?></p>
                                      <p style="margin-top:-1rem;">a.n. Kepala <?= ucwords(strtolower($instansi->nama_instansi_alt)) ?></p>
                                      <p style="margin-top:-1rem"><?= ucwords(strtolower($instansi->kota_administrasi)) ?>,</p>
                                      <p style="margin-top:-1rem"><?= $skmk->nama_jabatan ?></p>
                                      <p style="margin-top:5rem"><u><?= $skmk->nama_pejabat ?></u></p>
                                      <p style="margin-top:-1rem">NIP. <?= $skmk->nip ?></p>
                                  </div>

                                  <div class="mt-3 mb-5" style="text-align: justify">
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