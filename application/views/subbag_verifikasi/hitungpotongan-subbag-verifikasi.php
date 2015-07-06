<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Hitung Potongan SubBag-SubBag verifikasi</title>
    </head>
    <body>
        <?php $this->load->view('headloader'); ?>
        <?php $this->load->view('subbag_verifikasi/menubar-subbag-verifikasi'); ?>
        
        <div class="ui one column page grid">
            <div class="column">
                <h4 class="ui top center aligned attached inverted blue block header">HITUNG PAJAK DAN POTONGAN LAIN</h4>

                <div class="ui two column grid">
                    <div class="column">
                        <div class="ui basic segment"> 
                            <div class="ui segment">
                                <div class="ui two column divided grid">
                                    <div class="column">
                                        <h4>Nomor Tagihan</h4>
                                    </div>
                                    <div class="column">
                                        <h4><?php echo $nomortagihan; ?></h4>
                                    </div>
                                </div>
                                <div class="ui two column divided grid">
                                    <div class="column">
                                        <h4>Nama Pekerjaan</h4>
                                    </div>
                                    <div class="column">
                                        <h4><?php echo $namapekerjaan; ?></h4>
                                    </div>
                                </div>
                                <div class="ui two column divided grid">
                                    <div class="column">
                                        <h4>Nilai Pekerjaan</h4>
                                    </div>
                                    <div class="column">
                                        <h4>Rp <?php echo $nilaipekerjaan; ?>,00</h4>
                                    </div>
                                </div>
                                <div class="ui two column divided grid">
                                    <div class="column">
                                        <h4>Vendor : </h4>
                                    </div>
                                    <div class="column">
                                        <h4><?php echo $vendor; ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="ui blue segment">
                    <div class="grouped inline fields">
                        <div class="field">
                            <h3>penghitungan di field ini</h3>
                        </div>
                    </div>
                    <div class="grouped inline fields">
                        <div class="field">
                            Lorem ipsum dolor sit amet
                        </div>
                    </div>
                </div>
                <form class="ui fluid form segment" action="<?php echo base_url('subbagverifikasi/teruskan'); ?>" method="POST" id="registrasiForm">
                    <input type="hidden" name="idtagihan" value="<?php echo $idtagihan; ?>">
                    <input type="hidden" name="nomortagihan" value="<?php echo $nomortagihan; ?>">
                    <input type="hidden" name="namapekerjaan" value="<?php echo $namapekerjaan; ?>">
                    <input type="hidden" name="nilaipekerjaan" value="<?php echo $nilaipekerjaan; ?>">
                    <input type="hidden" name="vendor" value="<?php echo $vendor; ?>">
                    <input class="ui blue submit button" name="commit" value="TERUSKAN">
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
