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
 *                    'toggle_fields'=>null,
 *                    'toggled_by'=>array('field_name'=>'option'),
 *                    'preview'=>null
 *                 ),
 *             ),
 *         ),
 *     ),
 * );
 */

$page_title_settings_fields = array(
    'section'=>'settings',
    'tabs' => array(
        'settings'=>array(
            'label'=>'Settings',
            'fields'=>array(
                'confine_section'=>select_field(array(
                        'name'=>'confine_section',
                        'label'=>'Confine Section',
                        'args'=>array('no','yes')
                    )
                ),
                'float_section'=>select_field(array(
                        'name'=>'float_section',
                        'label'=>'Float Section',
                        'args'=>array('no','yes'),
                        'toggle_fields'=>array(
                            'yes'=>'top_margin,bottom_margin,outer_glow'
                        )
                    )
                ),
                    'top_margin'=>text_field(array(
                            'name'=>'top_margin',
                            'label'=>'Top Margin',
                            'args'=>array('suffix','px'),
                            'toggled_by'=>array('float_section'=>'yes')
                        )
                    ),
                    'bottom_margin'=>text_field(array(
                            'name'=>'bottom_margin',
                            'label'=>'Bottom Margin',
                            'args'=>array('suffix','px'),
                            'toggled_by'=>array('float_section'=>'yes')
                        )
                    ),
                    'outer_glow'=>select_field(array(
                            'name'=>'outer_glow',
                            'label'=>'Outer Glow',
                            'args'=>array('none','left_and_right','top_and_bottom','top','bottom','all_sides'),
                            'toggled_by'=>array('float_section'=>'yes')
                        )
                    ),
                'use_breadcrumbs'=>select_field(array(
                        'name'=>'use_breadcrumbs',
                        'label'=>'Use breadcrumbs',
                        'args'=>array('no','yes')
                    )
                ),
            )
        )
    )
);


$page_title_settings_tabs = array(
    'background' => $background_fields,
    'borders' => $borders_fields,
    'headings' => $headings_fields,
    'text' => $text_fields,
    'images' => $images_fields,
    'page_title_settings' => $page_title_settings_fields
);