<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Konfirmasi Upload Dokumen</title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
        <?php $this->load->view('headloader'); ?>
        <?php $this->load->view('vendor/menubar-vendor'); ?>
        
        <div class="ui one column page grid">
            <div class="column">
                <h4 class="ui top center aligned attached inverted blue block header">KONFIRMASI UPLOAD DOKUMEN</h4>

                <form class="ui fluid form segment" action="<?php echo base_url('vendor/performupload'); ?>" method="POST" id="registrasiForm">
                    <div class="two fields">
                        <div class="field">
                            <label>Vendor</label>
                            <h3><?php echo $_SESSION['namavendor']; ?></h3>
                        </div>

                    </div>
                    <div class="two fields">                        
                        <div class="field">
                            <label>Nomor Tagihan</label>
                            <h3></h3>
                        </div>
                        <div class="field">
                            <label>Nama Pekerjaan</label>
                            <h3></h3>
                        </div>
                    </div>
                    <br>

                    <h4 class="ui top center aligned attached inverted blue block header">KELENGKAPAN DOKUMEN</h4>


                    <?php foreach ($checklist as $res) { ?>


                        <div class="ui blue segment">
                            <div class="grouped inline fields">
                                <div class="field">
                                    <div class="ui checkbox">
                                        <input name="syarat<?php echo $res['id_komponenberkas']; ?>" type="checkbox" value="<?php echo $res['id_komponenberkas']; ?>">
                                        <label><?php echo $res['nama_komponenberkas']; ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php } ?>

                    <input class="ui blue submit button" name="commit" value="SIMPAN">
                </form>
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
                $('.ui.checkbox').checkbox();

                $('#popupDatepicker').datepick({dateFormat: 'dd/mm/yyyy'});


                //Update Form error prompt
                $("#registrasiForm").form({
                    nomortagihan: {
                        identifier: 'nomortagihan',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Wajib diisi!'
                            }
                        ]
                    },
                    namapekerjaan: {
                        identifier: 'namapekerjaan',
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
