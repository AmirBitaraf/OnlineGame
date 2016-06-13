<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 ?>

  <style media="screen">
    .people:hover{
      cursor: pointer;
    }
  </style>
   <div class="row-fluid">

     <div class="box-content">

      <table class="table table-striped table-bordered bootstrap-datatable datatable">
        <thead>
          <tr>
            <th>Username</th>            
            <th>Role</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($users as $u) { ?>
        <tr onclick="select(this)" class="people" id="10">
          <td><?php echo $u->firstname." ".$u->lastname; ?></td>
          <td class="center"><?php echo $u->role; ?></td>
        </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>

   </div>
