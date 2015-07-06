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
        <?php $this->load->view('subbid/menubar-subbid'); ?>
        
        <div class="ui one column page grid" id="formCek">
            <div class="column">
                <!--Search box-->
                <!--End of Search box-->
                <form class="ui fluid form segment" action="<?php echo base_url('subbid'); ?>" id="registrasiForm" >
                    <div class="fields">
                        <h2><font face="calibri"> Terima kasih </font></h2>
                        <h4><font face="calibri"> Dokumen tagihan berhasil diteruskan </font></h4>
                        <br>
                    </div>    
                    <div class="two fields">
                        <div class="field">
                            <br>
                            <input class="ui blue submit button" value="KEMBALI">
                        </div>
                        <div class="field">
                            
                        </div>
                    </div>
                </form>
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
