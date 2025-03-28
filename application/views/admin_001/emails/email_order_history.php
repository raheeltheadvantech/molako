<?php include('header_email.php');?>
<span style="font-family: 'Helvetica Neue', Helvetica, Arial,sans-serif; font-size:12px; color:#333;">
Dear <?php echo $data->first_name.' '.$data->last_name;?>,<br>
    <br>
	<p><strong>Comment:</strong><br><?php echo $data->comment; ?></p>
    <br> 
    <p>Your order status has been changed to <?php echo $data->order_shipping_status;?> for the order <?php echo $data->order_id; ?>.</p>
    <br>
	<p>If you want to get more information about your order login to your account at <a href="<?php echo site_url('login.html'); ?>"><?php echo $this->config->item('site_name'); ?></a>!</p>
    <br>
	<p>Thank you and have a great day!</p>
</span>

<?php include('footer_email.php');
