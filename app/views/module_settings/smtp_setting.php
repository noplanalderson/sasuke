<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Pengaturan SMTP</h1>

                    <div id="message" class="alert d-none">
                        <small class="message"></small>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Pengaturan</h6>
                        </div>
                        <div class="card-body">
                            <?= form_open('smtp-setting/submit', 'id="form_smtp" method="post" data-parsley-validate');?>
                            
                            <label>Protokol *</label>
                            <select name="protokol" id="protokol" class="form-control" required="required">
                                <option value="smtp" <?php if($config['protocol'] === 'smtp') : ?>selected="selected"<?php endif;?>>smtp</option>
                                <option value="sendmail" <?php if($config['protocol'] === 'sendmail') : ?>selected="selected"<?php endif;?>>sendmail</option>
                                <option value="mail" <?php if($config['protocol'] === 'mail') : ?>selected="selected"<?php endif;?>>mail</option>
                            </select>
                            
                            <label>Enkripsi *</label>
                            <select name="smtp_crypto" id="smtp_crypto" class="form-control" required="required">
                                <option value="ssl" <?php if($config['smtp_crypto'] == 'ssl') : ?>selected="selected"<?php endif;?>>SSL</option>
                                <option value="tls" <?php if($config['smtp_crypto'] == 'tls') : ?>selected="selected"<?php endif;?>>TLS</option>
                            </select>

                            <label>SMTP Host *</label>
                            <input type="text" id="smtp_host" name="smtp_host" placeholder="smtp.domain.com" class="form-control" value="<?= $config['smtp_host'] ?>" required="required" />

                            <label>SMTP Port *</label>
                            <input type="number" id="smtp_port" name="smtp_port" placeholder="Example : 587" class="form-control" value="<?= $config['smtp_port'] ?>" required="required" />

                            <label>SMTP User *</label>
                            <input type="email" id="smtp_user" name="smtp_user" placeholder="admin@domain.com" class="form-control" value="<?= $config['smtp_user'] ?>" required="required"/>

                            <label>SMTP Password *</label>
                            <input type="password" id="smtp_password" name="smtp_password" placeholder="********" class="form-control" value="<?= $config['smtp_pass'] ?>" required="required"/>

                            <input type="submit" class="my-3 btn btn-small btn-success" name="submit" value="Submit">
                            
                            <input type="reset" class="my-3 btn btn-small btn-primary" value="Reset">
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->