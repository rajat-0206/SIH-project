<div id="myModal" style="display:none; transition: all 0.4s ease">
<div class="modal" style="display:block;background-color: rgba(0,0,0,0.3); transition: all 0.4s ease; ">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Error</h4>
          <button type="button" class="close" data-dismiss="modal" onclick="closeModal()">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
         <?php echo $err; ?>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="closeModal()">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  </div>

  <script type="text/javascript">
    
    errmodal = document.getElementById("myModal");

var err = "<?php echo $err; ?>";

var ut = "<?php echo $username; ?>";



function closeModal(){

  errmodal.style.display="none";
}

if(err!="" )
{ if(ut!="")
{
  errmodal.style.display="block";
}
}
  </script>