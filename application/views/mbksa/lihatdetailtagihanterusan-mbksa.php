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
        <?php $this->load->view('mbksa/menubar-mbksa'); ?>

        <div class="ui one column page grid">
            <div class="column">
                <h4 class="ui top center aligned attached inverted blue block header">DETAIL DOKUMEN TAGIHAN</h4>

                <div class="ui two column grid">
                    <div class="column">
                        <div class="ui basic segment"> 
                            <div class="ui segment">
                                <div class="ui two column divided grid">
                                    <div class="column">
                                        <h4>Nomor Tagihan</h4>
                                    </div>
                                    <div class="column">
                                        <h4><?php echo @$specifictagihan['nomor_tagihan']; ?></h4>
                                    </div>
                                </div>
                                <div class="ui two column divided grid">
                                    <div class="column">
                                        <h4>Nama Pekerjaan</h4>
                                    </div>
                                    <div class="column">
                                        <h4><?php echo @$specifictagihan['nama_pekerjaan']; ?></h4>
                                    </div>
                                </div>
                                <div class="ui two column divided grid">
                                    <div class="column">
                                        <h4>Nilai Pekerjaan</h4>
                                    </div>
                                    <div class="column">
                                        <h4>Rp <?php echo @$specifictagihan['nilai_pekerjaan']; ?>,00</h4>
                                    </div>
                                </div>
                                <div class="ui two column divided grid">
                                    <div class="column">
                                        <h4>Vendor : </h4>
                                    </div>
                                    <div class="column">
                                        <h4><?php echo @$specifictagihan['nama_vendor']; ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="ui basic segment"> 
                            <div class="ui segment">
                                <form action="<?php echo base_url('mbksa/teruskan'); ?>" method="POST" id="teruskanForm">
                                    <div class="two fields">
                                        <div class="field">
                                            <h4 class="ui top center aligned attached inverted blue block header">Teruskan ke : </h4>
                                            <br>
                                            <label>Pilih subbid</label>
                                            <div class="ui fluid selection dropdown">
                                                <input name="teruskan" type="hidden" id="teruskan" value="" />
                                                <div class="default text">Bidang</div>
                                                <i class="dropdown icon"></i>
                                                <div class="menu">
                                                    <?php foreach ($subbiduser as $res) { ?>
                                                        <div class="item" data-value="<?php echo $res['id_user']; ?>"><?php echo $res['nama_user']; ?></div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <br>
                                            <input type="hidden" name="idtagihan" value="<?php echo $specifictagihan['id_tagihan'] ?>" >
                                            <input class="ui blue submit button" name="commit" value="TERUSKAN">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="ui blue segment">
                    <div class="grouped inline fields">
                        <div class="field">
                            <h3>Dokumen Tagihan yang disertakan oleh Vendor ini :</h3>
                        </div>
                    </div>
                    <div class="grouped inline fields">
                        <div class="field">
                            <ol>
                                <?php foreach ($checklisttagihan as $res) { ?>
                                    <li><?php echo $res['nama_komponenberkas']; ?></li>
                                    <br>
                                <?php } ?>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function () {
                $(document.getElementById("reg")).addClass("active");

                var originalState = $('#teruskanForm').clone();

                $('#registrasiForm').replaceWith(originalState);

                $('.ui.dropdown').dropdown({on: 'click'});


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
