
<div class="ui menu">
    <a class="item" id="sche" href="<?php echo base_url('mbksa'); ?>">
        <i class="book icon"></i> HOME
    </a>
    <div class="ui pointing dropdown link item">
        <i class="user icon"></i> TAGIHAN <i class="dropdown icon"></i>
        <div class="menu">
            <a class="item" href="<?php echo base_url('mbksa/baru'); ?>"><i class="dollar icon"></i>Tagihan Masuk dari Vendor</a>
            <a class="item" href="<?php echo base_url('mbksa/masuk'); ?>"><i class="dollar icon"></i>Tagihan Disposisi Subbid Umum</a>
            <a class="item" id="sche" href="<?php echo base_url('mbksa/pembayaran'); ?>"><i class="book icon"></i>Verifikasi Pembayaran Tagihan</a>
        </div>
    </div>
    <a class="item" id="sche" href="<?php echo base_url('mbksa/monitoring') ?>">
        <i class="book icon"></i> MONITORING TAGIHAN
    </a>            
    <div class="right menu">
        <form action="<?php echo base_url('logout') ?>" method="POST">
            <div class="ui dropdown link item">
                <i class="user icon"></i> MBKSA <i class="dropdown icon"></i>
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
