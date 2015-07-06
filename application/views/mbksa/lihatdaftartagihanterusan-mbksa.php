<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Lihat Daftar Tagihan Terusan - MBKSA</title>
    </head>
    <body>
        <?php $this->load->view('headloader'); ?>
        <?php $this->load->view('mbksa/menubar-mbksa'); ?>

        <div class="ui form segment">
            <h4 class="ui dividing header">Daftar Tagihan diajukan oleh Vendor</h4>

                <table class="ui celled definition table">
                    <thead>
                        <tr>
                            <th>Nomor Tagihan</th>
                            <th>Nomor Kontrak</th>
                            <th>Vendor</th>
                            <th>Nama Pekerjaan</th>
                            <th>Direksi</th>
                            <th>Nilai Kontrak</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php foreach ($dbresult as $key => $value) : ?>
                            <tr>
                                <td>
                                    <i class="folder icon"></i> <?php echo $value['nomor_tagihan']; ?>
                                </td>
                                <td><?php echo $value['nomor_kontrak']; ?></td>
                                <td><?php echo $value['id_vendor']; ?></td>
                                <td><?php echo $value['nama_pekerjaan']; ?></td>
                                <td><?php echo $value['direksi']; ?></td>
                                <td>Rp <?php echo number_format($value['nilai'], 2, ',', '.'); ?></td>
                                <td class="center aligned">
                                    <?php
                                    echo form_open(base_url('mbksa/detaildisposisi'));
                                    echo form_hidden('hidden_idtagihan', $value['id_tagihan']);
                                    ?>
                                    <input type="submit" class="ui blue submit button" value="DETAIL"/>
                                    <?php echo form_close(); ?>
                                </td>
                            </tr>    
                            <?php endforeach; ?>
                        
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
