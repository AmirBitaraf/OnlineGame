<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row-fluid sortable">
  <span><i>Send Message:</i></span>
  <div class="box span12">
    <div class="box-content">
      <form class="" action="<?php echo base_url();?>index.php/landing/sendmessage" method="post">
        <input class="span8 typeahead" type="text" name="text" value="Text">        
        <br>
        <button type="submit" class="btn btn-primary" name="button">Send</button>
      </form>
    </div>
  </div>

</div>