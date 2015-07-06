
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<div class="ui menu">
    <a class="item" id="sche" href="<?php echo base_url('vendor'); ?>">
        <i class="home icon"></i> HOME
    </a>
    <a class="item" id="sche" href="<?php echo base_url('vendor/kontrak'); ?>">
        <i class="upload disk icon"></i> UPLOAD BERKAS PENAGIHAN
    </a>
    <a class="item" id="sche" href="<?php echo base_url('vendor/dokumenkembali'); ?>">
        <i class="attention icon"></i> BERKAS KEMBALI
    </a>
    <div class="right menu">
        <form action="<?php echo base_url('logout'); ?>" method="POST">
            <div class="ui dropdown link item">
                <i class="user icon"></i> VENDOR <i class="dropdown icon"></i>
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