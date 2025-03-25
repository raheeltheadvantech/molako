<br />
<p style="margin-bottom:6px;"><i style="font-family: 'Helvetica Neue', Helvetica, Arial,sans-serif; font-size:12px; color:#333;">Thank you,</i></p>
<br><br>
<?php if( $this->config->item('config_owner') != '' ) : ?>
<span style="font-family:'Helvetica Neue', Helvetica, Arial,sans-serif; font-size:16px; color:#333;"><?php echo $this->config->item('config_owner')?></span><br>
<?php endif; ?>

<?php if( $this->config->item('config_name') != '' ) : ?>
<span style="font-family:'Helvetica Neue', Helvetica, Arial,sans-serif; font-size:12px; color:#333;"><?php echo $this->config->item('config_name')?> Team</span><br>
<?php endif; ?>

<a style="color:#4c4ce1;" href="<?php echo base_url(); ?>"><?php echo base_url(); ?></a><br />

<span style="font-size:12px; font-family:Arial, Helvetica, sans-serif;">
<?php if( $this->config->item('config_email') != '' ) : ?>
EMAIL: <a style="color:#333;font-style:italic;" href="mailto:<?php echo $this->config->item('config_email')?>"><?php echo $this->config->item('config_email')?></a><br>
<?php endif; ?>

<?php if( $this->config->item('config_telephone') != '' ) : ?>
PHONE: <span style=" font-style:italic;"><?php echo $this->config->item('config_telephone')?></span><br>
<?php endif; ?> 

<?php if( $this->config->item('config_fax') != '' ) : ?>
FAX: <span style=" font-style:italic;"><?php echo $this->config->item('config_fax')?></span><br>
<?php endif; ?>
</span>


</body>
</html>
