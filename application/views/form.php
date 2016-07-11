<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div class="row-fluid">
  <span><i>Message Box:</i><i id="messageBox"></i></span>

  <div class="box-content">
   <table class="table table-striped table-bordered bootstrap-datatable datatable">
     <thead>
       <tr>
         <th>Username</th>
         <th>Role</th>
         <th>Text</th>
         <th>Vote</th>
         <th></th>
       </tr>
     </thead>
     <tbody>
      <?php foreach($messages as $m) { ?>
     <tr>
       <td><?php echo $m->firstname." ".$m->lastname; ?></td>
       <td class="center"><?php echo $m->role; ?></td>
       <td class="center">
        <?php echo $m->me_text; ?>
       </td>
       <td>
         <?php echo ($m->votes ? $m->votes : 0); ?>
       </td>
       <td>
         <?php if(!$isKing){ ?><a href="<?php echo base_url();?>index.php/landing/upvote?id=<?php echo $m->id ?>"><button type="button" class="btn btn-primary" name="button" >Upvote</button></a><?php } ?>
       </td>
     </tr>
     <?php } ?>
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
