<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
.ul-1{}
.ul-1 li a{ font-weight:bold;}

.ul-1 li .ul-2{ margin-left:10px;}
.ul-1 li .ul-2 li{}
.ul-1 li .ul-2 li a{font-weight:normal;}

</style>

<div class="container">

    <div class="row">
        <div class="col-xs-12">
            <div class="content-wrapper">
                <div class="page-header">
					<h1><?php echo $page_header?></h1>
                </div><!-- Page Header -->
            </div><!-- Content Wrapper -->
        </div>
    </div>
	<div class="row">
        <div class="col-sm-12">
            
            <ul class="ul-1">
                <li>
                    <a href="<?php echo site_url('c/1-wheels.html') ?>">WHEELS</a>
                    <ul class="ul-2">
                        <li><a href="<?php echo site_url('b/26-vision-american-muscle.html') ?>">Vision American Muscle</a></li>
                        <li><a href="<?php echo site_url('b/27-vision-atv.html') ?>">Vision ATV</a></li>
                        <li><a href="<?php echo site_url('b/28-vision-heavy-duty.html') ?>">Vision Heavy Duty</a></li>
                        <li><a href="<?php echo site_url('b/30-vision-off-road.html') ?>">Vision Off Road</a></li>
                        <li><a href="<?php echo site_url('b/6-vision-wheels.html') ?>">Vision Wheels</a></li>
                        <li><a href="<?php echo site_url('b/3-weld-racing.html') ?>">Weld Racing</a></li>
                    </ul>
                </li>
                <li>    
                    <a href="<?php echo site_url('c/4-tires.html') ?>">TIRES</a>
                    <ul class="ul-2">
                        <li><a href="<?php echo site_url('b/2-hoosier.html') ?>">Hoosier</a></li>
                        <li><a href="<?php echo site_url('b/1-mickey-thompson.html') ?>">Mickey Thompson</a></li>
                    </ul>
                </li>
            </ul>

        </div>
	</div>
</div>