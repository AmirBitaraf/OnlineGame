<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/materialize.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="<?php echo base_url();?>css/signup.css" rel="stylesheet" >

    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/materialize.min.js"></script>
</head>
<body id="login-page">
<div >
    <div  class="row" id="form_login">

        <div class="col s3 offset-s1 z-depth-4 card-panel" style="margin-top: 10%">
            <!-- send form -->
            <?php echo form_error();?>
            <?php echo form_open('landing/login');?>
            <div class="row s8">
                <div class="col s12">
                    <h4>Login</h4>
                </div>
                <div class="input-field col s12">
                    <!-- <i class="mdi-social-person-outline prefix"></i> -->
                    <input id="username" type="text" class="validate" name="username">
                    <label for="UserName">User Name</label>
                </div>
                <div class="input-field col s12">
                    <!-- <i class="mdi-action-lock-outline prefix"></i> -->
                    <input id="password" type="password" name="password">
                    <label for="password">Password</label>
                    <div class="input-field col s6 offset-s3">
                        <input class="btn waves-effect waves-light col s12" type="submit" value="login">
                    </div>
                    <div class="input-field col s6 m6 l6">
                        <p class="margin right-align medium-small">
                            <a href="<?php echo base_url();?>index.php/landing/forgetPass">Forgot password?</a>
                        </p>
                    </div>
                    <div class="input-field col s6 m6 l6">
                        <p class="margin right-align medium-small">
                            <a href="<?php echo base_url();?>index.php/landing/loadregister">signup!</a>
                        </p>
                    </div>
                </div>
            </div>
            <?php echo form_close();?>
        </div>
        <div class="col s8">

            <div class="col s8 offset-m3 intro-message" style="margin-top: 10%" >
                <h1 style="color: white">
                    Make Your Reign!
                </h1>
                <p style="margin-left: 30%;color: white">
                    Game And Enjoy!
                </p>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/js/materialize.min.js"></script>
</div>
</body>
</html>
