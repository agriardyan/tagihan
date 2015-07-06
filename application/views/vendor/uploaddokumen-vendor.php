<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Upload Dokumen-Vendor</title>
    </head>
    <body>
        <?php $this->load->view('headloader'); ?>
        <?php $this->load->view('vendor/menubar-vendor'); ?>

        <div class="ui one column page grid">
            <div class="column">
                <h4 class="ui top center aligned attached inverted blue block header">UPLOAD DOKUMEN</h4>

                <div class="ui fluid form segment">
                    <?php echo form_open_multipart(base_url('vendor/performupload'), array('id' => 'registrasiForm')); ?>
                    <div class="two fields">
                        <div class="field">
                            <h3 class="ui dividing header"><?php echo $_SESSION['namauser']; ?></h3>
                            <input name="namavendor" type="hidden" value="<?php echo @$nama_vendor; ?>" >
                        </div>
                    </div>
                    <div class="two fields">                        
                        <div class="field">
                            <label>Nama Pekerjaan</label>
                            <h3><?php echo @$kontrak['nama_pekerjaan']; ?></h3>
                        </div>  
                        <div class="field">
                            <label>Nomor Kontrak</label>
                            <h3><?php echo @$kontrak['nomor_kontrak']; ?></h3>
                        </div>
                    </div>
                    <div class="two fields">                        
                        <div class="field">
                            <label>Direksi Pekerjaan</label>
                            <h3><?php echo @$kontrak['direksi']; ?></h3>
                        </div>
                        <div class="field">
                            <label>Nilai Pekerjaan</label>
                            <h3>Rp <?php echo number_format($kontrak['nilai'], 2, ',', '.'); ?></h3>
                        </div>
                    </div>
                    <div class="two fields">
                        <br/>
                        <h4 class="ui top center aligned attached inverted blue block header">DETAIL TAGIHAN</h4>
                        <br/>   
                        <div class="field">
                            <label>Nomor Tagihan</label>
                            <div class="ui left labeled icon input">
                                <input name="nomortagihan" placeholder="e.g. 01/TAG/VI/2015" type="text" value="" >
                                <i class="text file outline icon"></i>
                            </div>
                        </div>
                        <div class="field">
                            <label for="uploadberkas">Upload berkas</label>
                            <input class="ui transparent button" name="userfile" id='uploadberkas' type="file">
                        </div>
                    </div>
                    <br>

                    <h4 class="ui top center aligned attached inverted blue block header">CHECKLIST KELENGKAPAN DOKUMEN</h4>
                    <div class="ui blue segment">

                        <?php foreach ($checklist as $res) : ?>

                            <div class="grouped inline fields">
                                <div class="field">
                                    <div class="ui checkbox">
                                        <input name="syarat<?php echo $res['id_komponenberkas']; ?>" type="checkbox" value="<?php echo $res['id_komponenberkas']; ?>">
                                        <label><?php echo $res['nama_komponenberkas']; ?></label>
                                    </div>
                                </div>
                            </div>


                        <?php endforeach; ?>

                    </div>
                    <input class="ui blue submit button" type="submit" name="commit" value="SIMPAN">

                    <?php 
                    echo form_hidden('hidden_idkontrak', $idkontrak);
                    echo form_close(); 
                    ?>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function () {
                $(document.getElementById("reg")).addClass("active");

                var originalState = $('#registrasiForm').clone();

                $('#registrasiForm').replaceWith(originalState);

                $('.ui.dropdown').dropdown({on: 'click'});
                $('.ui.checkbox').checkbox();


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
                    userfile: {
                        identifier: 'userfile',
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
