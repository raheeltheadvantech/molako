<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="containter">
    <div class="row">
        <div class="col-sm-12">
            <h2><?php echo $page_header; ?></h2>
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <td class="text-left" colspan="2">Contact Details</td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-left" style="width: 50%;">
                        <b>Contact Id:</b> <?php echo $result->contact_us_id; ?>
                    </td>
                </tr>
                <tr>
                    <td class="text-left" style="width: 50%;">
                        <b>Date Added:</b> <?php echo format_date($result->date_added); ?>
                    </td>
                </tr>
                <tr>
                    <td class="text-left" style="width: 50%;">
                        <b>Name:</b> <?php echo $result->name; ?>
                    </td>
                </tr>
                <tr>
                    <td class="text-left" style="width: 50%;">
                        <b>Email:</b> <a href="mailto:<?php echo $result->email; ?>"><?php echo $result->email; ?></a>
                    </td>
                </tr>
                <tr>
                    <td class="text-left" style="width: 50%;">
                        <b>Phone:</b> <a href="tel:<?php echo $result->phone; ?>"><?php echo $result->phone; ?></a>
                    </td>
                </tr>
                <tr>
                    <td class="text-left" style="width: 50%;">
                        <b>Message:</b> <?php echo $result->message; ?>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="buttons clearfix">
<!--                <div class="pull-left"><a href="--><?php //echo site_url($this->admin_folder .'/join_club_list.html') ?><!--" class="btn btn-primary">Back</a></div>-->
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click','#button-history', function () {
        $('#order-history-form').submit();
    });
</script>
