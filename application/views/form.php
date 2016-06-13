<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-content">
      <form class="" action="<?php echo base_url();?>index.php/landing/" method="post">
        <input class="span8 typeahead" type="text" name="name" value="Text">
        <input  type="hidden" name="people" value="">
        <br>
        <button type="submit" class="btn btn-primary" name="button">Submit Form</button>
      </form>
    </div>
  </div>

</div>

<form class="" action="<?php echo base_url();?>index.php/landing/getallmessages" method="post">
    <input type="hidden" name="inboxpeople" id="people_input_box" value="">
    <button type="submit" class="btn btn-primary" name="button">Get Inbox</button>
</form>

<div class="row-fluid">
  <span><i>Message Box Owener:</i><i id="messageBox"></i></span>

  <div class="box-content">
   <table class="table table-striped table-bordered bootstrap-datatable datatable">
     <thead>
       <tr>
         <th>Username</th>
         <th>Role</th>
         <th>Text</th>
         <th>Vote</th>
         <th>VoteUp</th>
       </tr>
     </thead>
     <tbody>
     <tr>
       <td>Dennis Ji</td>
       <td class="center">Member</td>
       <td class="center">
        salam to every one
       </td>
       <td>
         20
       </td>
       <td>
         <button type="button" class="btn btn-primary" onclick="upvote(this)" name="button" >Upvote</button>
       </td>
     </tr>
     </tbody>
   </table>
 </div>

</div>









<script type="text/javascript">
    var t=0;
    function select(p) {
      var name =p.childNodes[1].innerHTML;//.innerHTML;
      var messageBox=document.getElementById('messageBox');
      var owner=document.getElementById('ownerMessage');
      var form_sender_people=document.getElementById('people_input_box');
      form_sender_people.value=name;
      owner.innerHTML=name;
      messageBox.innerHTML=name;

    }
    function upvote(name) {
      vote=name.parentNode.parentNode.childNodes[7].innerHTML;
      var a=parseInt(vote);
      a=a+1;
      name.parentNode.parentNode.childNodes[7].innerHTML=a;

    }


</script>






</div>  <!--This End Of Content <div> in the sidebar page (By container fluid )-->
</div>   <!-- End container fluid full-->
</div>
