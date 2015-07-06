<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Detail Monitoring Tagihan - MBKSA</title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
        <?php $this->load->view('headloader'); ?>
        <?php $this->load->view('mbksa/menubar-mbksa'); ?>

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
                            <form target="_blank" action="<?php echo base_url('mbksa/lihatfile') ?>" method="POST">
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
                </div>


                <form class="ui fluid form segment" action="<?php echo base_url('mbksa'); ?>" method="POST" id="registrasiForm">

                    <?php $counter = 1;
                    foreach ($dbresult as $res) { ?>
                        <div class="ui blue segment">
                            <div class="grouped inline fields">
                                <div class="field">
                                    <h4><?php echo $counter++; ?></h4>
                                    <p><?php echo $res['keterangan'] ?></p>
                                    <br/>
                                    <ul>
                                        <li>Pelaksana : <?php echo $res['nama_user'] ?></li>
                                        <li>Selesai pada : <?php echo $res['time'] ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
<?php } ?>
                    <div class="ui blue segment">
                        <div class="grouped inline fields">
                            <div class="field">
                                <h4><?php echo $counter++; ?></h4>
                                <p><?php echo $workingphase ?></p>
                                <br/>
                                <ul>
                                    <li>Pelaksana : <?php echo $currentuser ?></li>
                                    <li>Selesai pada : -</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <input class="ui blue submit button" name="commit" value="KEMBALI">
                </form>

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
