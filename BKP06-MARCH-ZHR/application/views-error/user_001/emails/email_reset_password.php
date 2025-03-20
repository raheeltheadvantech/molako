<?php include('header_email.php');?>

<span style="font-family: 'Helvetica Neue', Helvetica, Arial,sans-serif; font-size:12px; color:#333;">
Dear <?php echo $user->first_name.' '.$user->last_name;?>,<br>

    <p>You password has been reset successfully at <?php echo $this->config->item('config_name')?>.</p>
<br>
<br>
</p>
Thank you and have a great day!

</span>

<?php include('footer_email.php');