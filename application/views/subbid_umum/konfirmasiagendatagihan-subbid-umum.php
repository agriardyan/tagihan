<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
        <?php $this->load->view('headloader'); ?>
        <?php $this->load->view('subbid_umum/menubar-subbid-umum'); ?>

        <div class="ui one column page grid">
            <div class="column">
                <h4 class="ui top center aligned attached inverted blue block header">AGENDA TAGIHAN MASUK</h4>
                <form class="ui fluid form segment" id="registrasiForm" >
                    <div class="two fields">
                        <div class="field">
                            <label>Vendor</label>
                            <h3><?php echo $namavendor; ?></h3>
                            <input name="namavendor" type="hidden" value="<?php echo $namavendor ?>" >
                        </div>
                        <div class="field">
                        </div>
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label>Tanggal Masuk</label>
                            <h3><?php echo $tanggalmasuk; ?></h3>
                        </div>
                        <div class="field">
                            <label>Nomor Tagihan</label>
                            <h3><?php echo $nomortagihan; ?></h3>
                        </div>
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label>Nama Pekerjaan</label>
                            <h3><?php echo $namapekerjaan; ?></h3>
                        </div>
                        <div class="field">
                            <label>Nilai Pekerjaan</label>
                            <h3>Rp <?php echo $nilaipekerjaan; ?>,00</h3>
                        </div>
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label>Teruskan ke</label>
                            <h3><?php echo $teruskanval; ?></h3>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="ui two column page grid">
            <div class="left floated left aligned column">
                <div class="field">
                    <form class="ui fluid form segment" action="revisi" method="POST" id="revisiForm" >
                        <input type="hidden" name="tanggalmasuk" value="<?php echo $tanggalmasuk; ?>" />
                        <input type="hidden" name="nomortagihan" value="<?php echo $nomortagihan; ?>" />
                        <input type="hidden" name="namapekerjaan" value="<?php echo $namapekerjaan; ?>" />
                        <input type="hidden" name="nilaipekerjaan" value="<?php echo $nilaipekerjaan; ?>" />
                        <input type="hidden" name="teruskan" value="<?php echo $teruskan; ?>" />
                        <input class="ui blue submit button" type="submit" name="commit" value="REVISI" />
                    </form>
                </div>
            </div>
            <div class="right floated right aligned column">
                <div class="field">
                    <form class="ui fluid form segment" action="<?php echo base_url('subbidumum/updateagenda'); ?>" method="POST" id="simpanForm" >
                        <input type="hidden" name="tanggalmasuk" value="<?php echo $tanggalmasuk; ?>" />
                        <input type="hidden" name="teruskan" value="<?php echo $teruskan; ?>" />
                        <input type="hidden" name="idtagihan" value="<?php echo $idtagihan; ?>">
                        <input class="ui blue submit button" type="submit" name="commit" value="SUBMIT" />
                    </form>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                $(document.getElementById("reg")).addClass("active");

                var originalState = $('#registrasiForm').clone();
                var originalStateSearch = $('#searchVendor').clone();

                $('#registrasiForm').replaceWith(originalState);
                $('#searchVendor').replaceWith(originalStateSearch);

                $('.ui.dropdown').dropdown({on: 'click'});

                $("#revisiForm").form({
                },
                {
                    on: 'submit',
                    inline: 'true'
                });

                //Update Form error prompt
                $("#simpanForm").form({
                },
                {
                    on: 'submit',
                    inline: 'true'
                });
            });
        </script>
        
    </body>
</html>
