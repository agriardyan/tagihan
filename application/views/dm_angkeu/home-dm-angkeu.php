<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Home-DM Angkeu</title>
    </head>
    <body>
        <?php $this->load->view('headloader'); ?>
        <?php $this->load->view('dm_angkeu/menubar-dm-angkeu'); ?>
        
        
        <script type="text/javascript">
            $(document).ready(function () {
                $(document.getElementById("reg")).addClass("active");
                
                $('.ui.dropdown').dropdown({on: 'click'});

                //Update Form error prompt
            });
        </script>
    </body>
</html>
