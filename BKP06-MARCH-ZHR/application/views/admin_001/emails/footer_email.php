<br />
<p style="margin-bottom:6px;"><i style="color:#999;font-size:13px;">Sincerely,</i></p>
<?php if( $this->config->item('owner') != '' ) : ?>
<span style="font-family:'Helvetica Neue', Helvetica, Arial,sans-serif; font-size:16px; color:#333;"><?php echo $this->config->item('owner')?></span><br>
<?php endif; ?>

<?php if( $this->config->item('site_name') != '' ) : ?>
<span style="font-family:'Helvetica Neue', Helvetica, Arial,sans-serif; font-size:12px; color:#333;"><?php echo $this->config->item('site_name')?></span><br>
<?php endif; ?>
<br />


<span style="font-size:12px; font-family:Arial, Helvetica, sans-serif;">
<?php if( $this->config->item('email') != '' ) : ?>
EMAIL: <a style="color:#333;font-style:italic;" href="mailto:<?php echo $this->config->item('email')?>"><?php echo $this->config->item('email')?></a><br>
<?php endif; ?>

<?php if( $this->config->item('phone') != '' ) : ?>
PHONE: <span style=" font-style:italic;"><?php echo $this->config->item('phone')?></span><br>
<?php endif; ?>

<?php if( $this->config->item('fax') != '' ) : ?>
FAX: <span style=" font-style:italic;"><?php echo $this->config->item('fax')?></span><br>
<?php endif; ?>
</span>

<a style="color:#333;font-style:italic;" href="<?php echo base_url(); ?>"><?php echo base_url(); ?></a><br />

</body>
</html>
