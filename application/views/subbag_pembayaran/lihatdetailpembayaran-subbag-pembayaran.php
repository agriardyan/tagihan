<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Lihat Detail Tagihan - Manager Bidang</title>
    </head>
    <body>
        <?php $this->load->view('headloader'); ?>
        <?php $this->load->view('subbag_pembayaran/menubar-subbag-pembayaran'); ?>

        <div class="ui one column page grid">
            <div class="column">
                <div class="ui fluid form segment">
                    <h4 class="ui dividing header">Detail Tagihan</h4>
                    <div class="two fields">
                        <div class="field">
                            <label>Vendor</label>
                            <h3><?php echo @$specifictagihan['nama_vendor']; ?></h3>
                            <input name="namavendor" type="hidden" value="<?php echo @$specifictagihan['nama_vendor']; ?>" >
                        </div>
                        <div class="field">
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
                            <h3>Rp <?php echo @$specifictagihan['nilai_pekerjaan']; ?>,00</h3>
                        </div>
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label>Tanggal Masuk</label>
                            <h3><?php echo @$specifictagihan['tanggal_masuk']; ?></h3>
                        </div>
                        <div class="field">
                            <label>Lihat Berkas</label>
                            <div class="ui button" id="lihatberkas" name="lihatberkas" >Klik untuk Lihat Berkas</div>
                        </div>
                    </div>
                    <br/>
                    <form action="<?php echo base_url('subbagpembayaran/pembayaranselesai'); ?>" method="POST" id="teruskanForm">
                    
                        <input type="hidden" name="idtagihan" value="<?php echo @$specifictagihan['id_tagihan']; ?>">
                        <input class="ui blue submit button" name="commit" value="SELESAI">
                    
                    </form>
                </div>
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
                        <?php foreach ($checklisttagihan as $res) { ?>
                            <li><?php echo $res['nama_komponenberkas']; ?></li>
                            <br>
                        <?php } ?>
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

                var originalState = $('#teruskanForm').clone();

                $('#teruskanForm').replaceWith(originalState);

                $('.ui.dropdown').dropdown({on: 'click'});

                $('#lihatberkas').on('click', function () {
                    $('#modalberkas').modal('show');
                });


                //Update Form error prompt
                $("#teruskanForm").form({
                    teruskan: {
                        identifier: 'teruskan',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Wajib diisi!'
                            }
                        ]
                    }
                },
                {
                    on: 'submit',
                    inline: 'true'
                });
            });
        </script>
    </body>
</html>
