<?php $__env->startComponent('mail::message'); ?>
<br>
    <h1><?php echo $details['title']; ?></h1>
    <p>Votre code est : <?php echo $details['code']; ?></p>
    <p>Le code expire dans 2 minutes</p>
     
<p>Merci</p>
<p>L’équipe du Prix Pierre Castel</p> 
<?php echo $__env->renderComponent(); ?><?php /**PATH /var/www/top-patissier.net/resources/views/emails/code.blade.php ENDPATH**/ ?>