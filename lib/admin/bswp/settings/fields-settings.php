<?php

namespace bswp\settings;

/**
 * Each set of fields can be automatically generated using ths following array
 * structure for settings:
 *
 *
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
 *                    'toggle_fields'=>array('option'=>'field_1,field_2,field_3'),
 *                    'toggled_by'=>array('field_name'=>'option1,option2,option3'),
 *                    'preview'=>null
 *                 ),
 *             ),
 *         ),
 *     ),
 * );
 */


include_once('prefilled-selects.php');

// Reusable fields
function text_field($settings = array()){
    extract($settings);
    $name = isset($name) ? $name : 'field';

    return array(
       'name'=> $name,
       'label'=> isset($label) ? $label : ucfirst(str_replace(array('-','_'), ' ', $name ) ),
       'type'=> isset($type) ? $type : 'text',
       'args'=> isset($args) ? $args : null,
       'toggle_fields'=> isset($toggle_fields) ? $toggle_fields : null,
       'toggled_by'=> isset($toggled_by) ? $toggled_by : null,
       'preview'=>null,
       'class'=>isset($class) ? $class : '',
       'wrapper_class'=>isset($wrapper_class) ? $wrapper_class : '',
    );
};


function text_decoration_field($args = array()){
    $args['name'] = $args['name'] ? $args['name'] : 'text_decoration';
    $args['label'] = isset($args['label']) ? $args['label'] : 'Text Decoration';

    $args['args'] = array(
                    'none',
                    'overline',
                    'underline',
                    'line-through',
                    'text-shadow',
                );
    return select_field($args);
}

function text_shadow_color_field($args=array()){
    $args['name'] = $args['name'] ? $args['name'] : 'text_shadow_color';
    return color_field($args);
}

function sortable_field($args = array()){
    $args['type'] = 'sortable';
    return text_field($args);
}


function color_field($args = array()){
    $args['name'] = isset($args['name']) ? $args['name'] : 'color';
    $args['type'] = 'color';
    return text_field($args);
}

function sidebar_field($args = array()){
    $args['type'] = 'sidebar';
    return text_field($args);
};

function select_field($args = array()){
    $args['type'] = 'select';
    return text_field($args);
};

function file_field($args = array()){
    $args['type'] = 'file';
    return text_field($args);
}

function textarea_field($args = array()){
    $args['type'] = 'textarea';
    return text_field($args);
}

function label_field($args = array()){
    extract($args);
    $args['type'] = 'label';
    return text_field($args);
}

function no_field($args = array()){
    $args['name'] = isset($args['name']) ? $args['name'] : '';
    $args['type'] = 'no';
    return text_field($args);
}

function hidden_field($args = array()){
    $args['name'] = isset($args['name']) ? $args['name'] : '';
    $args['type'] = 'hidden';
    return text_field($args);
}

/**
 * Helpers
 */

// All the components are basically just a bunch of color fields
function components_field_settings($fields = array()){

    $array = array();
    foreach($fields as $k=>$v){

        $args = array();

        if(is_array($v)){
            $args = array(
                'name'=>str_replace(' ','_',strtolower($k) ),
                'type'=>$v['type'] ? $v['type'] : 'color',
                'args'=>$v['args'] ? $v['args'] : null,
            );
        }
        else{
            $args = array(
                'name'=>str_replace(' ','_',strtolower($v) ),
                'type'=>'color'
            );
        }


        $array[ $args['name'] ] = call_user_func($args['type'].'_field', $args);
    }
    return $array;
}

/**
 * Pixel width helper - Adds 'px' to each step in the range
 * used for stuff like border widths
 * @param [type] $index [description]
 */
function add_px_string($index){
    return ($index.'px');
}


/**
 * Global fields
 *
 * These fields appear in most, if not all sections
 */
include('fields-background.php');
include('fields-border.php');
include('fields-headings.php');
include('fields-text.php');
include('fields-components.php');
include('fields-image.php');

// misc
include('fields-sidebar-location.php');
include('fields-layout.php');
/**
 * Section specific fields
 *
 * These files contina the sections' misc settings fields, or the wierd one offs
 * like the general theme settings, or the "special backgrounds", page temaplates ect
 */

include('section-settings-theme.php');
include('section-settings-header.php');
include('section-settings-navbar.php');
include('section-settings-nav-dropdown.php');
include('section-settings-mobile-nav.php');
include('section-settings-page-title.php');
include('section-settings-body.php');
include('section-settings-feed.php');
include('section-settings-footer.php');
include('section-settings-login.php');