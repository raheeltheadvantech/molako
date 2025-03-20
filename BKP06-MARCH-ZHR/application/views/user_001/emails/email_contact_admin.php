<?php include('header_email.php');?>

<span style="font-family: 'Helvetica Neue', Helvetica, Arial,sans-serif; font-size:12px; color:#333;">
Dear <?php echo $this->site_config->item('config_owner');?>,<br>

	<p>We have received a message from contact us page from <?php echo $this->config->item('site_name')?>.</p>
	<p>Following are the details of the message</p>
	<br>
	<p>----------------------------------------------------</p>
	<p><b>Name:</b> <?php echo $name; ?></p>
	<p><b>Email:</b> <?php echo $email; ?></p>
	<p><b>Message:</b> <?php echo $message; ?></p>
	<p>----------------------------------------------------</p>
	<p>Thank you and have a great day!</p>
</span>

<?php include('footer_email.php');
