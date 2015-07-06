<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Lihat Detail Tagihan - MBKSA</title>
    </head>
    <body>
        <?php $this->load->view('headloader'); ?>
        <?php $this->load->view('subbid_umum/menubar-subbid-umum'); ?>

        <div class="ui one column page grid">
            <div class="column">
                <h4 class="ui top center aligned attached inverted blue block header">DETAIL DOKUMEN KEMBALI</h4>
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
                                    <form target="_blank" action="<?php echo base_url('subbidumum/lihatfile') ?>" method="POST">
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
                                    <label>Lihat Berkas</label>
                                    <div class="ui button" id="lihatberkas" name="lihatberkas" >Klik untuk Lihat Berkas</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="ui blue fluid segment">
                    <div class="grouped inline fields">
                        <div class="field">
                        </div>
                    </div>
                    <div class="grouped inline fields">
                        <div class="ui fluid form segment">
                            <div class="field">
                                <h4 class="ui dividing header">Dokumen tersebut dikembalikan karena ketidaklengkapan berkas : </h4>
                                <?php echo @$specifictagihan['keterangan']; ?> 
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                echo form_open(base_url('subbidumum/kembalikan'), array('id' => 'registrasiForm')); 
                echo form_hidden('hidden_idtagihan', @$specifictagihan['id_tagihan']);
                ?>
                <div class="ui fluid form segment">
                    <input class="ui blue submit button" name="commit" value="KEMBALI KE VENDOR">
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>

        <div class="ui modal" id="modalberkas">
            <i class="close icon"></i>
            <div class="header">
                Kelengkapan Berkas
            </div>
            <div class="content">
                <div class="description">
                    <div class="ui header">Berikut ini berkas yang disertakan oleh vendor ini.</div>
                    <ol>
                        <?php foreach ($checklisttagihan as $res) : ?>
                            <li><?php echo $res['nama_komponenberkas']; ?></li>
                            <br>
                        <?php endforeach; ?>
                    </ol>
                </div>
            </div>
            <div class="actions">
                <div class="ui positive right labeled icon button">
                    Tutup
                    <i class="checkmark icon"></i>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function () {
                $(document.getElementById("reg")).addClass("active");

                var originalState = $('#registrasiForm').clone();

                $('#registrasiForm').replaceWith(originalState);

                $('.ui.dropdown').dropdown({on: 'click'});

                $('#lihatberkas').on('click', function () {
                    $('#modalberkas').modal('show');
                });

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
