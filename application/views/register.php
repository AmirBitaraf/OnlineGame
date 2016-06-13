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
<body>
<div id="register-page">
  <div  class="row" id="form_register">    
  
    <div class="col s6 offset-s3 z-depth-4 card-panel">
      <!-- send form -->
      <?php echo form_error();?>
      <?php echo form_open('landing/register');?>
        <div class="row s8">
          <div class="input-field col s12 center">
            <img src="<?php echo base_url(); ?>image/icon.png" alt="" class="responsive-img valign profile-image-login">
            <p class="center login-form-text"><i style="color:gray">Enjoy Gaming!</i></p>
          </div>
          <div class="input-field col s6">
            <!-- <i class="mdi-social-person-outline prefix"></i> -->
            <input id="firstname" type="text" class="validate" name="firstname">
            <label for="firstname">First Name</label>
          </div>
          <div class="input-field col s6">
            <!-- <i class="mdi-social-person-outline prefix"></i> -->
            <input id="lastname" type="text" class="validate" name="lastname">
            <label for="lastname">Last Name</label>
          </div>
          <div class="input-field col s6">
            <!-- <i class="mdi-social-person-outline prefix"></i> -->
            <input id="username" type="text" class="validate" name="username">
            <label for="UserName">User Name</label>
          </div>
          <div class="input-field col s6">
            <!-- <i class="mdi-social-person-outline prefix"></i> -->
            <input class="validate" id="email" type="email" name="email">
            <label for="email" data-error="wrong" data-success="right">Email</label>
          </div>
          
          <div class="input-field col s6">
            <!-- <i class="mdi-social-person-outline prefix"></i> -->
            <select id="country" name="country" style="display: block;">
              <option disabled selected>Select Country...</option>
              <option value="-1">Register New Country</option>
              <?php foreach($countries as $c) { ?>
              <option value="<?php echo $c->id;?>"><?php echo $c->name;?></option>
              <?php } ?>
            </select>            
          </div>
          
          <div class="input-field col s6" id="cnameDiv" style="display:none;">
            <!-- <i class="mdi-social-person-outline prefix"></i> -->
            <input class="validate" id="cname" type="text" name="cname">
            <label for="cname" data-error="wrong" data-success="right">Country Name</label>
          </div>
          
          <div class="input-field col s12">
            <!-- <i class="mdi-action-lock-outline prefix"></i> -->
            <input id="password" type="password" name="password">
            <label for="password">Password</label>
          <div class="input-field col s6 offset-s3">
            <input class="btn waves-effect waves-light col s12" type="submit" value="Register">
          </div>
          <div class="input-field col s6 m6 l6">
            <p class="margin medium-small">
              <a href="<?php echo base_url();?>index.php/landing/loadlogin">Login</a>
            </p>
          </div>
          <div class="input-field col s6 m6 l6">

          </div>
        </div>
      </div>
      <?php echo form_close();?>
    </div>
  </div>
  <div class="col s3 offset-s3"></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/js/materialize.min.js"></script>
    <script>
      $(function(){
        $("form").submit(function(){
          if (!$("#country").val()) {
            alert("Please Specify Country!");
            event.preventDefault();
          }
        });
        $("#country").change(function(){
          if ($("#country").val()=="-1") {
            $("#cnameDiv").show();
          }
          else $("#cnameDiv").hide();
        });
      })
    </script>
</div>
</body>
</html>
