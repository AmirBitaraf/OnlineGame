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
            <th>Date registered</th>
            <th>Role</th>
          </tr>
        </thead>
        <tbody>
        <tr onclick="select(this)" class="people" id="10">
          <td>Dennis Ji</td>
          <td class="center">2012/01/01</td>
          <td class="center">Member</td>
        </tr>
        <tr onclick="select(this)" class="people" id="10">
          <td>Mostafa Ebrahimi</td>
          <td class="center">2012/01/01</td>
          <td class="center">Member</td>
        </tr>

        </tbody>
      </table>
    </div>

   </div>

<span><i>Owener:</i><i id="ownerMessage"></i></span>
