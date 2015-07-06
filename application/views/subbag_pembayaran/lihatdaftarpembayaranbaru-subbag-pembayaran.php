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
        <?php $this->load->view('subbag_pembayaran/menubar-subbag-pembayaran'); ?>

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
                    <tr>
                        <?php foreach ($dbresult as $key => $value) { ?>
                            <td>
                                <i class="folder icon"></i> <?php echo $value['nomor_tagihan']; ?>
                            </td>
                            <td><?php echo $value['nomor_kontrak']; ?></td>
                            <td><?php echo $value['id_vendor']; ?></td>
                            <td><?php echo $value['nama_pekerjaan']; ?></td>
                            <td><?php echo $value['direksi']; ?></td>
                            <td><?php echo 'Rp ' . number_format($value['nilai'], 2, ',', '.'); ?></td>
                            <td class="center aligned">
                                <?php
                                echo form_open(base_url('subbagpembayaran/detailpembayaran'));
                                echo form_hidden('hidden_idtagihan', $value['id_tagihan']);
                                ?>
                                <input type="submit" class="ui blue submit button" value="DETAIL"/>
                                <?php echo form_close(); ?>
                            </td>
                        <?php } ?>
                    </tr>
                </tbody>
            </table>
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
