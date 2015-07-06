<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Hasil Verifikasi</title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
        <?php $this->load->view('headloader'); ?>
        <?php $this->load->view('subbid_umum/menubar-subbid-umum'); ?>

        <div class="ui one column page grid">
            <div class="column">
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

                <?php 
                if ($success === true) : 
                        
                ?>
                    <div class="ui fluid form segment">

                        <div class="field">
                            <!--Success Message-->
                            <div class="ui positive message" id="success">
                                <div class="header">
                                    Berkas tagihan lengkap
                                </div>
                                <p>Silakan meneruskan berkas tagihan ini ke Sub Bagian Verifikasi</p>
                            </div>
                        </div>
                        
                        <div class="ui two column page grid">
                            <div class="left floated left aligned column">
                                <?php echo form_open(base_url('subbidumum/fkembali')); ?>
                                <input class="ui red submit button" name="commit" type="submit" value="KEMBALI">
                                <?php 
                                echo form_hidden('hidden_idtagihan', $idtagihan);
                                echo form_close();
                                ?>
                            </div>
                            <div class="right floated right aligned column">
                                <?php echo form_open(base_url('subbidumum/teruskan')); ?>
                                <input class="ui blue submit button" name="commit" type="submit" value="TERUSKAN">
                                <?php 
                                echo form_hidden('hidden_idtagihan', $idtagihan);
                                echo form_close();
                                ?>
                            </div>
                        </div>
                        
                    </div>
                <?php 
                
                else : 
                    echo form_open(base_url('subbidumum/kembalikan'));
                ?>
                    <div class="ui fluid form segment">

                        <div class="field">
                            <!--Negative Message-->                        
                            <div class="ui negative message" id="success">
                                <div class="header">
                                    Berkas tagihan tidak lengkap
                                </div>
                                <p>Silakan mengembalikan berkas tagihan ini ke Sub Bidang Umum</p>
                                <p>Berkas yang tidak lengkap sebagai berikut : </p>
                                <div class="description">
                                    <?php echo $keterangan; ?>
                                </div>
                                <br>
                                <div class="field" >
                                    <h7 class="ui dividing header">Keterangan Tambahan :</h7>
                                    <textarea name="keterangan" ></textarea>
                                </div>
                            </div>
                            <!--End of Negative Message-->
                        </div>
                        <input class="ui blue submit button" type="submit" name="commit" value="KEMBALIKAN">
                    </div>
                <?php 
                echo form_hidden('hidden_idtagihan', $idtagihan);
                echo form_hidden('keterangan1', $keterangan);
                echo form_close();
                endif; 
                ?>
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
