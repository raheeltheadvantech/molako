<?php
 // dd($options);
?>
<table class="table" id="variantEditTable">
    <thead>
    <tr>
        <?php
        //remove image element from array
        // unset($columns[0]);
        ?>
 
         <?php foreach($options as $k=>$val){?>
        <th><?php echo $k; ?></th>
        <?php } ?>
        <th>Price</th>
        <th>Stock</th>
        <th>SKU</th>
        <th>Image</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
        <tr style="display: none;" id="copy_row">
            <input type="hidden" name="product_option_value_id[]"
               value=" ">
        <?php
        //remove image element from array
        // unset($columns[0]);
        ?>
 
         <?php foreach($options as $k => $val){


        $op = $val;

    ?>
    <td>
            <select onchange="ch_attr()" name="variants_combination[<?= $k ?>][]" class="form-control"> 
                <option value="">Select <?php echo ucfirst(strtolower($k))?></option>               
                <?php
                foreach ($op as $key => $value) {
                    ?>
                    <option value="<?= $value ?>"><?php echo ucfirst(strtolower($value)) ?></option>

                    <?php
                }
                ?>

            </select>

        </td>
        <?php } ?>
        <td>
            <input type="text" name="variants_price[]" class="form-control"/>
        </td>
        <td>
            <input type="text" name="variants_quantity[]" class="form-control"/>
        </td>
        <td>
            <input type="text" name="variants_sku[]" class="form-control"/>
        </td>
        <td>
            <div class="col-sm-8">
            <input type="file" name="image_file[]" class="form-control" id="imageUpload">
            </div>
            <div class="col-sm-4">
        <button type="button" class="upatt_img btn btn-primary">Upload</button></div>
            <input type="hidden" name="att_img[]" class="att_img" />
        </td>
        <td id="uploadedImageContainer" class="uploadedImageContainer"></td>
        <td>
            <button type="button" onclick="remo_var()" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
        </td>
    </tr>
    <?php $num= 1; foreach($rows as $val) { ?>
    <tr>

        <input type="hidden" name="product_option_value_id[]"
               value="<?php echo $val['product_option_value_id']; ?>">

         
         <?php 
         $comb = $val['combination'];


         foreach($options as $k => $val1){


        $op = $val1;

    ?>
    <td>
            <select name="variants_combination[<?= $k ?>][]" class="form-control"> 
                <option value="">Select <?php echo ucfirst(strtolower($k))?></option>               
                <?php
                foreach ($op as $key => $value) {
                    ?>
                    <option value="<?= $value ?>" <?php echo  (isset($comb[$k]) && $comb[$k] == $value?'selected':'NO') ?>><?php echo ucfirst(strtolower($value)) ?></option>

                    <?php
                }
                ?>

            </select>

        </td>
        <?php } ?>
        <td>
            <div class="common-txtField">
                <input style="width: 100%" class="form-control variants_price<?php echo $num;?>"
                       type="text" name="variants_price[]"
                       value="<?php  echo $val['price']; ?>"
                       >
            </div>
        </td>
        <td>
            <div class="common-txtField">
                <div class="quantity">
                    <input style="width: 100%" class="form-control option_qty<?php echo $num;?>"
                           type="text" name="variants_quantity[]"
                           value="<?php echo $val['quantity']; ?>"
                            >
                </div>
            </div>
        </td>
        <td>
            <div class="common-txtField"><input style="width: 100%" class="form-control option-sku<?php echo $num;?>"
                                                type="text" name="variants_sku[]"
                                                value="<?php echo $val['sku']; ?>" readonly></div>
        </td>
        <td>
            <div class="col-sm-8">
            <input type="file" name="image_file[]" class="form-control" id="imageUpload" <?= (isset($val['image']) && $val['image'])?'disabled':''; ?>>
            </div>
            <div class="col-sm-4">
        <button type="button" onclick="uploadImage(event)" class="upatt_img btn btn-primary">Upload</button></div>
            <input type="hidden" name="att_img[]" class="att_img" />
        </td>
        <td id="uploadedImageContainer" class="uploadedImageContainer">
            <?php
            if(isset($val['image']) && $val['image'])
            {
                ?>
                        <img src="<?= base_url(); ?>/images/products/small/<?= $val['image'] ?>" class="img-thumbnail" width="100">
                        <button type="button" class="btn btn-danger removeImage" >Remove</button>

                <?php

            }
            ?>
        </td>
        <td>
            <button type="button" onclick="remo_var()" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
        </td>
    </tr>
    <?php $num++; } ?>
    </tbody>
    <tfoot><tr> <td colspan="<?= count($options)+4 ?>"></td><td><td>
            <button type="button" onclick="copy_row();" class="btn btn-primary">+</button>
        </td></td> </tr></tfoot>
    
</table>
<script type="text/javascript">
    function countOccurrences(color, colorArray) {
    let count = 0;
    colorArray.forEach(item => {
        if (item === color) {
            count++;
        }
    });
    return count;
}
    function checkDuplicateSelects(sval) {
        //New logic
        let selectValues = [];
        $('#variantEditTable tr').each(function(){
            var row = $(this);
        console.log($(this).attr('id'));
        if($(this).attr('id') != 'copy_row')
        {
            var v = [];
            $(this).find('select').each(function(){
                v.push($(this).val());
            });
            selectValues.push(v.join('|'));

        }

        });
        var r = countOccurrences(sval, selectValues);
        return (r > 1)?true:false;
        //New logic
}
    $('#variantEditTable').on('change', 'select, input[name="product_name[]"]', function () {
        const row = $(this).closest('tr');
        var v = [];
        row.find('select').each(function(){
                v.push($(this).val());
            });
        sval = v.join('_');
        if(!sval)
        {
            return 0;
        }
        var chk = checkDuplicateSelects(v.join('|'));
        if(chk)
        {
            alert('Variation already exist');
            // row.remove();
            row.find('select').each(function(){
                $(this).val('')
            });
        }

        // Get selected values
        const productName = $('input[name="product_name"]').val().trim();
        // ;

        const skuField = row.find('input[name="variants_sku[]"]');
        if (sval) {
            // Combine values to generate SKU
            const uniqueCode = Math.floor(Math.random() * 1000);
            skuField.val(`${productName}-`+sval+``);
        } else {
            skuField.val(''); // Clear if any field is empty
        }
    });
    $('table').on('click', '.upatt_img', function (event) {
        
            const row = $(this).closest('tr'); // Use the passed element to find the row
            const row_img = row.find('.att_img');
    uploadImage(event,row_img)
    });
    function uploadImage(event,row_img) {
    const inputFile = event.target.closest('tr').querySelector('input[type="file"]');
    const file = inputFile.files[0];
    const imageContainer = event.target.closest('tr').querySelector('#uploadedImageContainer');
    const formData = new FormData();

    if (file) {
        formData.append('file', file); // 'image' is the name of the parameter for the file on the server-side
        formData.append('ajax', 1); // 'image' is the name of the parameter for the file on the server-side
        imageContainer.innerHTML = `Uploading....`;

        // Perform AJAX upload
        $.ajax({
            url: '<?php echo site_url($this->admin_url .'/'. $this->controller_dir .'/product/image-uploader.html'); ?>', // Replace with your upload handler URL
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                response= JSON.parse(response);
                if (response.success) {
                    // On success, display the uploaded image and show remove button
                    const imageContainer = event.target.closest('tr').querySelector('#uploadedImageContainer');
                    const imageURL = response.file_name; // Assuming the server responds with the uploaded image URL
                    const savefile = response.savefile; // Assuming the server responds with the uploaded image URL
                    imageContainer.innerHTML = `
                        <img src="${imageURL}" class="img-thumbnail" width="100">
                        <button type="button" class="btn btn-danger removeImage" >Remove</button>
                    `;
                    row_img.val(savefile);
                    inputFile.disabled = true; // Disable the file input after image is uploaded
                    event.target.disabled = true; // Disable the upload button after image is uploaded
                } else {
                    const imageContainer = event.target.closest('tr').querySelector('#uploadedImageContainer');
                    imageContainer.innerHTML = ``;
                    alert('Image upload failed!');
                }
            },
            error: function() {
                alert('An error occurred while uploading the image.');
            }
        });
    }
    else
    {
    }
}

// Function to remove the uploaded image
$('table').on('click','.removeImage', function (event) {
        
            const row = $(this).closest('tr'); // Use the passed element to find the row
            const row_img = row.find('.att_img');
            const imageContainer = row.find('#uploadedImageContainer');
    removeImage(event,imageContainer,row_img)
    });
function removeImage(event,imageContainer,row_img) {
    const row = $(this).closest('tr'); // Use the passed element to find the row
    const inputFile = event.target.closest('tr').querySelector('input[type="file"]');
    const uploadButton = event.target.closest('tr').querySelector('button[type="button"]');

    // Remove the image and remove button
    imageContainer.html('');
    row_img.val('del');

    // Re-enable the file input and upload button
    inputFile.disabled = false;
    uploadButton.disabled = false;
}

// Function to remove the row (existing functionality)
function remo_var() {
    let row = event.target.closest('tr');
    row.remove();
    ch_attr();  // Recalculate after removing a row
}
</script>