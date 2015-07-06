<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Lihat Daftar Kontrak - Vendor</title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
        <?php $this->load->view('headloader'); ?>
        <?php $this->load->view('vendor/menubar-vendor'); ?>

        <div class="ui form segment">
            <h4 class="ui dividing header">Daftar Kontrak Anda dengan UPJB</h4>

                <table class="ui celled definition table">
                    <thead>
                        <tr>
                            <th>Nomor Kontrak</th>
                            <th>ID Eproc</th>
                            <th>Nama Pekerjaan</th>
                            <th>Direksi</th>
                            <th>Nilai Kontrak</th>
                            <th>Date Kontrak</th>
                            <th>Selesai Kontrak</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php foreach ($kontrakarray as $key => $value) { ?>
                                <td>
                                    <i class="folder icon"></i> <?php echo $value['nomor_kontrak']; ?>
                                </td>
                                <td><?php echo $value['id_eproc']; ?></td>
                                <td><?php echo $value['nama_pekerjaan']; ?></td>
                                <td><?php echo $value['direksi']; ?></td>
                                <td><?php echo 'Rp '.number_format($value['nilai'], 2, ',', '.'); ?></td>
                                <td><?php echo $value['date_kontrak']; ?></td>
                                <td><?php echo $value['akhir_kontrak']; ?></td>
                                <td class="center aligned">
                                    <?php
                                    echo form_open(base_url('vendor/tagih'));
                                    echo form_hidden('hidden_idkontrak', $value['id_kontrak']);
                                    ?>
                                    <input type="submit" class="ui blue submit button" value="TAGIH"/>
                                    <?php echo form_close(); ?>
                                </td>
                            <?php } ?>
                        </tr>
                    </tbody>
                </table>
        </div>
        
        <script type="text/javascript">
            $(document).ready(function() {
                $(document.getElementById("reg")).addClass("active");

                var originalState = $('#registrasiForm').clone();

                $('#registrasiForm').replaceWith(originalState);

                $('.ui.dropdown').dropdown({on: 'click'});
                
            });
        </script>

    </body>
</html>
