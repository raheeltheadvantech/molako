<?php include('header_email.php');?>

<span style="font-family: 'Helvetica Neue', Helvetica, Arial,sans-serif; font-size:12px; color:#333;">
Dear <?php echo $user->first_name .' '. $user->last_name;?>,<br>
	<p style="margin: 0px; 0px 0px 15px">Thank you for joining The Club at <?php echo $this->config->item('config_name')?>!</p>
	<p style="margin: 0px; 0px 0px 15px; color: #757575">You now have INSTANT ACCESS to discounts on all of your online orders!</p>
	<p style="margin: 0px; 0px 0px 15px ; color: #757575">We strive to offer competitive pricing and the best deals out there. It's also a great way to keep track of your purchases and favorites you saved.</p>
	<br>
	<p style="margin: 0px; 0px 0px 15px; color: #CC0000">A Bad Day Racing Is Better Than a Good Day Working!</p>
</span>

<?php include('footer_email.php');
