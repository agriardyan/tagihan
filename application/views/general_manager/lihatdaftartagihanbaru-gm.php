<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Lihat Daftar Tagihan Baru-SubBag</title>
    </head>
    <body>
        <?php $this->load->view('headloader'); ?>
        <?php $this->load->view('general_manager/menubar-gm'); ?>

        <div class="ui two center aligned column grid">
            <div class="column">
                <h3 class="ui blue inverted center aligned top attached header">TAGIHAN BARU</h3>
                <div class="ui form stacked segment"> 
                    <?php
                        foreach ($dbresult as $res) {
                    ?>
                        
                    <a href = "<?php echo base_url('gm/lihatdetail?idtag='.$res['id_tagihan']); ?>">
                        <div class = "ui blue segment">
                        <div class = "ui three column divided grid">
                        <div class = "center aligned column">
                        <p><?php echo $res['nomor_tagihan']; ?></p>
                        </div>
                        <div class = "center aligned column">
                        <p><?php echo $res['nama_vendor']; ?></p>
                        </div>
                        <div class = "center aligned column">
                        <p><?php echo $res['nama_pekerjaan']; ?></p>
                        </div>
                        </div>
                        </div>
                        </a>
                    
                    <?php
                        
                    };
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
            });
        </script>
    </body>
</html>
