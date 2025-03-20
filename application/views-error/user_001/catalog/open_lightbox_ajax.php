<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if(!empty($result->images)): ?>

    <?php $counter = 0; ?>
    <div class="lightbox-content">
        
		<?php foreach($result->images as $key_img=>$val_img) : ?>
        	
            <?php $counter++; ?>
            
            <div class="mySlides">
                <div class="numbertext"><?php echo $counter; ?> / <?php echo sizeof($result->images); ?></div>
                <a onclick="oczoom.plusSlides(1)" ><img src="<?php echo $val_img->L; ?>" alt=""></a>
				<span class="close cursor" onclick="oczoom.closeLightBox()">&times;</span>
				
            </div>
        
		<?php endforeach; ?>
		
        <span class="closezoom" onclick="oczoom.closeLightBox()"></span>
    </div>
    
	<span class="closezoom" onclick="oczoom.closeLightBox()"></span>
    <a class="prev" onclick="oczoom.plusSlides(-1)">&#10094;</a>
	<a class="next" onclick="oczoom.plusSlides(1)">&#10095;</a>

<?php else: ?>

    <div class="lightbox-content">No Image Data</div>
	<span class="closezoom" onclick="oczoom.closeLightBox()"></span>
    
<?php endif; ?>


<script type="text/javascript">
	$( window ).resize(function() {
		var screenheight = $(window).height();
		$('.mySlides img').css('max-height', screenheight);
	});
	
	var screenheight = $( window ).height();
	$('.mySlides img').css('max-height', screenheight);
	
</script>
