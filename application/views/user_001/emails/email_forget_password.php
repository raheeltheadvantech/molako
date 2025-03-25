<?php include('header_email.php');?>

<span style="font-family: 'Helvetica Neue', Helvetica, Arial,sans-serif; font-size:12px; color:#333;">
Dear <?php echo $user->first_name.' '.$user->last_name;?>,<br>

    <p>Please use this <a href="<?php echo $user->link; ?>">link</a> to reset your password.</p>
<br>
    <p>If you still face issues, please copy the below link and paste it in your browser</p>
    <a href="<?php echo $user->link; ?>"><?php echo $user->link; ?></a>
<br>
<br>
</p>
Thank you and have a great day!

</span>

<?php include('footer_email.php');