<?php include('header_email.php');?>

<span style="font-family: 'Helvetica Neue', Helvetica, Arial,sans-serif; font-size:12px; color:#333;">
Dear <?php echo $user->first_name.' '.$user->last_name;?>,<br>

<p>Thank you for registering at <?php echo $this->config->item('site_name')?>.</p>
<br>
We look forward to working with you!
<br>

</p>
Thank you and have a great day!

</span>

<?php include('footer_email.php');