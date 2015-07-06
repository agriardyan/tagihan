<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Verifikasi Tagihan-SubBid</title>
    </head>
    <body>
        <?php $this->load->view('headloader'); ?>
        <?php $this->load->view('subbid/menubar-subbid'); ?>

        <div class="ui one column page grid">
            <div class="column">
                <h4 class="ui top center aligned attached inverted blue block header">DETAIL DOKUMEN TAGIHAN</h4>
                <div class="ui fluid form segment">
                    <div class="ui one column grid">
                        <div class="column">
                            <div class="two fields">
                                <div class="field">
                                    <label>Vendor</label>
                                    <h3><?php echo @$specifictagihan['id_vendor']; ?></h3>
                                    <input name="namavendor" type="hidden" value="<?php echo @$specifictagihan['id_vendor']; ?>" >
                                </div>
                                <div class="field">
                                    <form target="_blank" action="<?php echo base_url('subbid/lihatfile') ?>" method="POST">
                                        <input type="hidden" name="idtag" value="<?php echo @$specifictagihan['id_tagihan']; ?>">
                                        <input class="ui blue submit button" type="submit" value="LIHAT FILE">
                                    </form>
                                </div>
                            </div>
                            <div class="two fields">
                                <div class="field">
                                    <label>Nomor Tagihan</label>
                                    <h3><?php echo @$specifictagihan['nomor_tagihan']; ?></h3>
                                </div>
                                <div class="field">
                                    <label>Nomor Kontrak</label>
                                    <h3><?php echo @$specifictagihan['nomor_kontrak']; ?></h3>
                                </div>
                            </div>
                            <div class="two fields">
                                <div class="field">
                                    <label>Nama Pekerjaan</label>
                                    <h3><?php echo @$specifictagihan['nama_pekerjaan']; ?></h3>
                                </div>
                                <div class="field">
                                    <label>Nilai Pekerjaan</label>
                                    <h3>Rp <?php echo number_format(@$specifictagihan['nilai'], 2, ',', '.'); ?></h3>
                                </div>
                            </div>
                            <div class="two fields">
                                <div class="field">
                                    <label>Direksi Pekerjaan</label>
                                    <h3><?php echo @$specifictagihan['direksi']; ?></h3>
                                </div>
                                <div class="field">
                                    <label>Tanggal Masuk</label>
                                    <h3><?php echo @$specifictagihan['tanggal_masuk_agenda']; ?></h3>
                                </div>                                
                            </div>
                            <div class="two fields">
                                <div class="field">
                                </div>
                                <div class="field">
                                    <label>Keterangan dari Manajer Bidang</label>
                                    <div class="ui segment"><p><?php echo @$specifictagihan['keterangan']; ?></p></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php echo form_open(base_url('subbid/performverifikasi'), array('id' => 'registrasiForm')); ?>
                <div class="ui fluid form segment">
                    <h4 class="ui    dividing header">Kelengkapan Berkas</h4>
                    <div class="ui blue segment">
                        <?php foreach ($allkomponenberkas as $res) :
                            $stat = false;
                        ?>

                        <div class="grouped inline fields">
                            <div class="field">
                                <div class="ui checkbox">
                                <?php
                                    foreach ($checklisttagihan as $check) :
                                    if ($res['id_komponenberkas'] == $check['id_komponenberkas']) {
                                        $stat = true;
                                    }
                                    endforeach;
                                ?>

                                <?php if ($stat === TRUE) : ?>
                                    <input name="syarat<?php echo $res['id_komponenberkas'] ?>" type="checkbox" checked="true" value="<?php echo $res['id_komponenberkas'] ?>">
                                    <label><?php echo $res['nama_komponenberkas'] ?></label>
                                <?php  else : ?>
                                    <input name="syarat<?php echo $res['id_komponenberkas'] ?>" type="checkbox" value="<?php echo $res['id_komponenberkas'] ?>">
                                    <label><?php echo $res['nama_komponenberkas'] ?></label>
                                <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <?php endforeach; ?>

                    </div>
                    
                    <input type="hidden" name="hidden_idtagihan" value="<?php echo @$specifictagihan['id_tagihan']; ?>">
                    <input class="ui blue submit button" type="submit" name="commit" value="VERIFIKASI">
                </div>
        
                <?php echo form_close(); ?>
                
            </div>
            
        </div>

        <script type="text/javascript">
            $(document).ready(function () {
                $(document.getElementById("reg")).addClass("active");

                var originalState = $('#registrasiForm').clone();

                $('#registrasiForm').replaceWith(originalState);

                $('.ui.dropdown').dropdown({on: 'click'});


                //Update Form error prompt
                $("#registrasiForm").form({
                },
                        {
                            on: 'submit',
                            inline: 'true'
                        });
            });
        </script>

    </body>
</html>