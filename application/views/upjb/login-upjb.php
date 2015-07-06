<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login Sistem</title>
    </head>
    <body>
        <?php $this->load->view('headloader'); ?>
        <?php
        // put your code here
        ?>

        <div class="ui one column page grid">
            <div class="column">
                <h2 class="ui top center aligned attached inverted blue block header">
                    Monitoring Tagihan
                </h2>  
                <div class="ui info message">
                    <div class="header">    
                    </div>
                    <p>
                        Isi form dengan Username dan Password anda, pilih role pada "Log In sebagai" kemudian tekan tombol Sign In. <br>
                        Untuk informasi lebih lanjut, Anda dapat menghubungi administrator kami, terimakasih.
                    </p>
                </div>
            </div>
        </div>
        <div class="ui three column page grid">
            <div class="column"></div>
            <div class="column">
                <h4 class="ui top center aligned attached inverted red block header">
                    LOG IN
                </h4>
                <?php
                echo $this->session->flashdata('errormessage');
                echo validation_errors();
                echo form_open(base_url('login'), array('id' => 'loginForm'));
                ?>
                <div class="ui form segment attached">
                    <div class="field">
                        <div class="ui left icon input">                            
                            <input name="username" type="text" placeholder="Username">
                            <i class="user icon"></i>
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui left icon input">
                            <input name="password" type="password" placeholder="Password">
                            <i class="lock icon"></i>
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui fluid selection dropdown">
                            <input name="loggedas" type="hidden" id="loggedas" value="" />
                            <div class="default text">Log In sebagai</div>
                            <i class="dropdown icon"></i>
                            <div class="menu">
                                <div class="item" data-value="1">Staf UPJB</div>
                                <div class="item" data-value="2">Vendor</div>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <input class="ui tiny red button" type="submit" value="Log In" name="login">
                    </div>

                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="column"></div>
        </div>
        <!--Script-->
        <script type="text/javascript">
            $(document).ready(function () {
                $(document.getElementById("signin")).addClass("active");
                $(document.getElementById("right")).remove();
                $('.ui.dropdown').dropdown({on: 'click'});
                $("#loginForm").form({
                    username: {
                        identifier: 'username',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Masukkan username'
                            }
                        ]
                    },
                    password: {
                        identifier: 'password',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Masukkan password'
                            }
                        ]
                    },
                    loggedas: {
                        identifier: 'loggedas',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Pilih role'
                            }
                        ]
                    }
                }, {
                    on: 'submit',
                    inline: 'true'
                });
            });
        </script>
    </body>
</html>
