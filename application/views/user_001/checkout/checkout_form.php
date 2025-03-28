<div class="box grid-2 side_html">
                                <fieldset class="fieldset">
                                    <?php 
                                    if(!$first_name && isset($default['data']->first_name))
                                    {
                                        $first_name = $default['data']->first_name;
                                    }

                                    echo form_input_1(array('name'=>'first_name','required'=>'required', 'onkeydown' => 'return /^[a-zA-Z\s]*$/.test(event.key)', 'label'=>'First name *', 'class'=>'form-control', 'value'=>set_value('first_name', $first_name))); ?>
                                </fieldset>
                                <fieldset class="fieldset">
                                    <?php 
                                    if(!$last_name && isset($default['data']->last_name))
                                    {
                                        $last_name = $default['data']->last_name;
                                    }

                                    echo form_input_1(array('name'=>'last_name','required'=>'required', 'onkeydown' => 'return /^[a-zA-Z\s]*$/.test(event.key)', 'label'=>'Last name *',  'class'=>'form-control', 'value'=>set_value('last_name', $last_name))); ?>
                                </fieldset>
                            </div>
                            <div class="box grid-2">
                                <fieldset class="box fieldset">
                                <?php 

                                echo form_input_1(array('name'=>'phone', 'label'=>'Phone Number','required'=>'required','onkeyup'=>'formatPhone(this)', 'class'=>'form-control', 'value'=>set_value('phone', $phone))); ?>
                            </fieldset>
                            <fieldset class="box fieldset">
                                <?php 

                                echo form_input_1(array('name'=>'email', 'label'=>'Email (Optional)', 'class'=>'form-control', 'value'=>set_value('email', $email))); ?>
                            </fieldset>
                            </div>
                            <div class="box grid-2">
                                <fieldset class="fieldset">
                                    <?php 
                                    if(!$region_name
 && isset($default['data']->region_name))
                                    {
                                        $region_name = $default['data']->region_name
;
                                    }

                                    echo form_input_1(array('name'=>'region_name','required'=>'required', 'onkeydown'=>'return /[a-z]/i.test(event.key)', 'label'=>'Province *', 'class'=>'form-control', 'value'=>set_value('region_name', $region_name
))); ?>
                                </fieldset>
                                <fieldset class="fieldset">
                                    <?php 
                                    if(!$city && isset($default['data']->city))
                                    {
                                        $city = $default['data']->city;
                                    }

                                    echo form_input_1(array('name'=>'city','required'=>'required', 'onkeydown'=>'return /[a-z]/i.test(event.key)', 'label'=>'City *',  'class'=>'form-control', 'value'=>set_value('city', $city))); ?>
                                </fieldset>
                            </div>
                            <fieldset class="box fieldset">
                                <?php
                                    if(!$address_1 && isset($default['data']->address_1))
                                    {
                                        $address_1 = $default['data']->address_1;
                                    }
                                    $data = array('name'=>'address_1','required'=>'required', 'label'=>'Address', 'placeholder'=>'Address', 'class'=>'form-control ',  'value'=>set_value('address_1', $address_1, false), 'rows'=>4);
                                    echo form_textarea_1($data);
                                    ?>
                            </fieldset>
                            <fieldset class="box fieldset">
								<?php
                                    $data = array('name'=>'note','required'=>0, 'label'=>'Note', 'placeholder'=>'Note', 'class'=>'form-control ',  'value'=>set_value('note', $note, false), 'rows'=>4);
                                    echo form_textarea_1($data);
                                    ?>
                            </fieldset>