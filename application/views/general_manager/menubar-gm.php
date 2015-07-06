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
        
        <div class="ui menu">
            <a class="item" id="sche" href="<?php echo base_url('gm/tagihanbaru'); ?>">
                <i class="book icon"></i> TAGIHAN BARU
            </a>
            <a class="item" id="sche" href="<?php echo base_url('gm/semuatagihan'); ?>">
                <i class="book icon"></i> SEMUA TAGIHAN
            </a>
            <div class="right menu">
                <form action="<?php echo base_url('logout'); ?>" method="POST">
                    <div class="ui dropdown link item">
                        <i class="user icon"></i> GENERAL MANAGER <i class="dropdown icon"></i>
                        <div class="menu">
                            <table class="ui basic table">
                                <tr>
                                    <td>Nama</td>
                                    <td><?php echo $_SESSION['namauser'] ?></td>
                                </tr>
                                <tr>
                                    <td >Username</td>
                                    <td><?php echo $_SESSION['username'] ?></td>
                                </tr>
                            </table>
                            <input class="ui fluid tiny submit button" type="submit" name="logoutAd" value="Logout">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
