<?php
/**
 * $fields = array(
 *    'tabs'=>array(
 *        'tab-name'=>array(
 *            'label'=>'Tab Name',
 *            'fields'=>array(
 *                'color'=>array(
 *                    'name'=>'field-name',
 *                    'label'=>'Field Name',
 *                    'type'=>'field-type',
 *                    'args'=>'{string or array}',
 *                    'toggle_field'=>null,
 *                    'preview'=>null
 *                 ),
 *             ),
 *         ),
 *     ),
 * );
 */

$header_settings = array(
    'tabs' => array(
        'settings'=>array(
            'label'=>'Settings',
            'fields'=>array(
                'header_content'=>select_field(array(
                        'name'=>'header_content',
                        'label'=>'Header Content',
                        'args'=>array('logo','widgets')
                    )
                ),
                'logo_alignment'=>select_field(array(
                        'name'=>'logo_alignment',
                        'label'=>'Logo Alignment',
                        'args'=>array('left','center','right')
                    )
                ),
                'logo_margin'=>text_field(array(
                        'name'=>'logo_margin',
                        'label'=>'Push Logo down/up',
                        'args'=>array('suffix'=>'px')
                    )
                ),
                'header_height_label'=>label_field(array(
                        'label'=>'Force Header Height'
                    )
                ),
                'header_height_toggle'=>select_field(array(
                        'name'=>'header_height_toggle',
                        'label'=>'',
                        'args'=>array('yes','no')
                    )
                ),
                'header_height'=>text_field(array(
                        'name'=>'header_height',
                        'label'=>'',
                        'args'=>array('suffix','px')
                    )
                ),
                'confine_section'=>select_field(array(
                        'name'=>'confine_section',
                        'label'=>'Confine Section',
                        'args'=>array('yes','no')
                    )
                ),
                'float_section'=>select_field(array(
                     'name'=>'float_section',
                     'label'=>'Float Section',
                     'args'=>array('yes','no')
                    )
                ),
                'hide_on_mobile'=>select_field(array(
                     'name'=>'hide_on_mobile',
                     'label'=>'Hide on mobile?',
                     'args'=>array('yes','no')
                    )
                ),
            ),
        ),
    ),
);