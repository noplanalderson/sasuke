<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Manajemen User</h1>

                    <?= $messages ?>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar User</h6>
                        </div>
                        <div class="card-body">
                            <?= form_open_multipart('', 'method="post" id="demo-form2" data-parsley-validate');?>
                            
                            <label for="user_name">Username</label>
                            <input type="text" id="user_name" 
                                name="user_name" class="form-control" 
                                placeholder="Username" data-parsley-pattern="^[A-Za-z0-9_]{1,15}$" 
                                value="<?php if(empty(set_value('user_name'))) { echo $form_value['user_name']; } else { echo set_value('user_name'); }?>" 
                                required="required">

                            <label for="user_email">Email</label>
                            <input type="email" id="user_email" 
                                name="user_email" class="form-control" 
                                placeholder="Email User" 
                                value="<?php if(empty(set_value('user_email'))) { echo $form_value['user_email']; } else { echo set_value('user_email'); }?>" 
                                required="required">

                            <label for="id_type">Tipe User</label>
                            <select id="id_type" class="form-control" name="id_type" required="required">
                                <option value="">Pilih Tipe User</option>
                                <?php foreach ($user_type as $type) :?>
                                    <option value="<?= $type->id_type ?>" 
                                    <?php if(empty(set_value('id_type')) ? $form_value['id_type'] : set_value('id_type') == $type->id_type) :?> selected="selected"<?php endif;?>>
                                    <?= $type->user_type ?>
                                        
                                    </option>
                                
                                <?php endforeach;?>
                            </select>

                            <label for="user_picture">Foto User</label>
                            <input type="hidden" name="user_picture_old" <?php if(!empty($form_value['user_picture'])) : ?> value="<?= $form_value['user_picture'];?>" <?php endif;?>>
                            <input type="file" class="form-control" name="user_picture">

                            <input class="my-3" type="checkbox" 
                                name="is_active" value="TRUE" 
                                <?php if(empty(set_value('is_active')) ? $form_value['is_active'] : set_value('is_active') == $form_value['is_active']) :?> 
                                checked="checked"<?php endif;?>> 
                                <label for="user_picture">Aktivasi User</label>
                                <br/>
                            
                            <input type="submit" class="my-3 btn btn-small btn-success" name="submit" value="Submit">
                            
                            <input type="reset" class="my-3 btn btn-small btn-primary" value="Reset">
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->