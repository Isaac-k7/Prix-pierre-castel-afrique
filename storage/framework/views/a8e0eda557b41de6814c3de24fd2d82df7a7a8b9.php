<?php if($message = Session::get('success')): ?>
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong><?php echo $message; ?></strong>
</div>
<?php endif; ?>
  
<?php if($message = Session::get('error')): ?>
<div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong><?php echo $message; ?></strong>
</div>
<?php endif; ?>
   
<?php if($message = Session::get('warning')): ?>
<div class="alert alert-warning alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong><?php echo $message; ?></strong>
</div>
<?php endif; ?>
   
<?php if($message = Session::get('info')): ?>
<div class="alert alert-info alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong><?php echo $message; ?></strong>
</div>
<?php endif; ?>
  
<?php if($errors->any()): ?>
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>    
   Veuillez vérifier vos informations
</div>
<?php endif; ?><?php /**PATH /Applications/MAMP/htdocs/prix-catel-online/resources/views/layouts/flash-message.blade.php ENDPATH**/ ?>