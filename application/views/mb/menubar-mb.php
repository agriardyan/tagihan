<div class="ui menu">
    <a class="item" id="sche" href="<?php echo base_url('manbid'); ?>">
        <i class="book icon"></i> HOME
    </a>
    <a class="item" id="sche" href="<?php echo base_url('manbid/baru'); ?>">
        <i class="book icon"></i> TAGIHAN BARU
    </a>
    <div class="right menu">
        <form action="<?php echo base_url('logout'); ?>" method="POST">
            <div class="ui dropdown link item">
                <i class="user icon"></i> MANAGER BIDANG <i class="dropdown icon"></i>
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
