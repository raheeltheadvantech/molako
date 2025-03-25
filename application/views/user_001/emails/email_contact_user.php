<?php include('header_email.php');?>

<span style="font-family: 'Helvetica Neue', Helvetica, Arial,sans-serif; font-size:12px; color:#333;">
Dear <?php echo $user->name;?>,<br>

	<p>Thank you for <?php echo $user->type;?> at <?php echo $this->config->item('config_name')?>.</p>
	<p>We received your inquiry. Our representative will contact you shortly!</p>
	<br>
	<p><b>Email: </b><?php echo $user->email;?></p>
	<?php if($user->phone){?>
	<p><b>Phone: </b><?php echo $user->phone;?></p>
	<?php }?>
	<?php if($user->message){?>
	<p><b>Message: </b><?php echo $user->message;?></p>
	<?php }?>
	<br>
	<p>Thank you and have a great day!</p>
</span>

<?php include('footer_email.php');
