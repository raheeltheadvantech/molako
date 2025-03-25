<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<table class="table" id="variantEditTable">
    <thead>
    <tr>
        <?php
        //remove image element from array
        unset($columns[0]);
        ?>
 
         <?php foreach($columns as $val){?>
        <th><?php echo $val; ?></th>
        <?php } ?>
        <th></th>
    </tr>
    </thead>
    <tbody class="variant_body_rows">

    <?php $num= 1; foreach($rows as $val) { ?>
    <tr>

        <input type="hidden" name="product_option_value_id[]"
               value="<?php echo $val['product_option_value_id']; ?>">

         <?php foreach($val['combination'] as $key => $value) { ?>
        <td class="skuu" hidden data-val="_<?php echo $value;?>">_<?php  echo $value; ?></td>
        <td data-val="_<?php echo $value;?>"><?php  echo $value; ?>
        </td>
             <input type="hidden" name="variants_combination[<?php echo $key; ?>][]" value="<?php  echo $value ?>">
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
            <div class="action-area"><input style="width: 100%"
                                            class="btn btn-danger" type="button"
                                            name="del_btn" value="Delete"></div>
        </td>
    </tr>
    <?php $num++; } ?>
    </tbody>
</table>