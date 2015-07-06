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
        
        <div class="ui ordered vertical steps">
            <a class="step">
                <div class="content">
                    <div class="title">Previous Step</div>
                    <div class="description">Description</div>
                </div>
            </a>
            <a class="active step">
                <div class="content">
                    <div class="title">Active Step</div>
                    <div class="description">Description</div>
                </div>
            </a>
            <a class="disabled step">
                <div class="content">
                    <div class="title">Disabled Step</div>
                    <div class="description">Description</div>
                </div>
            </a>
        </div>

    </body>
</html>
