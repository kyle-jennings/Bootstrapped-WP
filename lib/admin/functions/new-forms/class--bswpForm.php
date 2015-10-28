<?php

class bswpForm{

    public $forms_root = '';
    public function __construct(){
    }

    // if there is something like a submit button or a wp_Editor, we grab the output and return it
    public function grab_function_output($func){
        ob_start();
            call_user_func('submit_button');
            $ob_content = ob_get_contents();

        ob_end_clean();

        return $ob_content;
    }


    /**
     * [init description]
     * @param  [array] $settings [nested array with all the section fields]
     * @return [string]           [the markup, dawg]
     */
    public function init($settings){

        if(!$settings)
            return;

        wp_enqueue_media();

        $output = '';
        $output .= '<form class="bswp-form" method="post" action="options.php">';
            $output .= '<div class="fields-wrapper">';

                $output .= '<div class="tab-content">';
                    $output .= $this->settings_tabs($settings);
                $output .= '</div>';

                $output .= $this->grab_function_output('submit_button');

            $output .= '</div>';
        $output .= '</form>';

        return $output;
    }

    /**
     * Each set of settings (backgrounds, borders, text ect) get their own tab-pane
     * becase we are keeping each section's settings on the same page
     * @return [type] [description]
     */
    public function settings_tabs($settings_group){


        $output = '';
        $i = 0;
        foreach($settings_group as $k=>$settings){
            $first = ($i == 0) ? 'active' : '';
            $id = $settings['section'];

            $output .= '<div id="'.$id.'" class="tab-pane '.$first.'">';
                $output .= $this->field_tabs($settings);
            $output .= '</div>';
            $i++;
        }

        return $output;
    }







    /**
     * This will create the settings fields and the settings dropdown.
     * IE - in the background settings, there are background colors and also
     * background wallpaper. Each of those are in their own tab pans, which are
     * activated with a dropdown menu button
     *
     * @param  array  $settings [description]
     * @return [type]           [description]
     */
    public function field_tabs($settings = array()){

        $tabs = $settings['tabs'];

        if( empty($tabs) )
            return;


        // if there are more than one tab, set this flag
        $multi_tabs = (count($tabs) > 1) ? true : false;

        $output ='';

        // if there is more than one tab we create a dropdown to navigate them
        if( $multi_tabs )
            $output .= $this->field_tab_dropdown($tabs);

        // get the tab pain
        $output .= $this->field_tab_pane($multi_tabs, $tabs);

        return $output;
    }

    /**
     * Here is the tab pane which displays the fields as mentioned above
     * @param  [type] $multi_tabs [description]
     * @param  [type] $tabs       [description]
     * @return [type]             [description]
     */
    public function field_tab_pane($multi_tabs, $tabs){

        $output = '';

        // the tab content
        if( $multi_tabs )
            $output .= '<div class="tab-content">';

        // generate the fields
        foreach($tabs as $tab)
            $output .= $this->create_tab_content($tab);

        // close tab content
        if( $multi_tabs )
            $output .= '</div>';

        return $output;
    }


    // the tab dropdown
    public function field_tab_dropdown($tabs){

        $output = '';

        $first_tab = reset($tabs);
        $first_label = $first_tab['label'];

        $output .= '<div class="btn-group tab-switcher">';
            $output .= '<a class="btn btn-primary dropdown-toggle tab-switcher__dropdown" data-toggle="dropdown" href="#">';
                $output .= '<span class="btn-face">'.$first_label.'</span>';
                $output .= '<span class="caret"></span>';
            $output .= '</a>';
            $output .= '<ul class="dropdown-menu">';

                foreach($tabs as $tab)
                    $output .= $this->field_tab_dropdown_link($tab);

            $output .= '</ul>';
        $output .= '</div>';

        return $output;
    }

    // The tab links in the dropdown
    public function field_tab_dropdown_link($tab){


        $label = $tab['label'];
        $name = str_replace(' ','_',strtolower($tab['label']));

        $output = '';
        $output .= '<li>';
            $output .= '<a href="#'.$name.'" data-toggle="tab">'.$label.'</a>';
        $output .= '</li>';

        return $output;
    }


    /**
     * Generates the markup for the tab contents
     */
    public function create_tab_content($tab){


        $name = str_replace(' ','_',strtolower($tab['label']));
        $label = $tab['label'];
        $fields = $tab['fields'];

        $output .= '<div class="tab-pane cf" id="'.$name.'">';
            $output .= '<h2>'.$label.'</h2>';
            $output .= $this->identify_fields($fields);
        $output .= '</div>';

        return $output;
    }

    /**
     * Identifies which field to use based on the 'type' key
     */
    public function identify_fields($fields = array()){

        $output = '';

        foreach($fields as $field){

            $type = $field['type'];

            ob_start();
                call_user_func( array($this, $type.'_field_generator'), $field);
                $ob_content = ob_get_contents();
            ob_end_clean();

            $output .= $ob_content;
        }

        return $output;
    }


// ------------------------------------------
//  The field generators
// ------------------------------------------

    public function text_field_generator( $args=array() ){
        extract($args);

        $data_field_toggle = $field_toggle ? $this->get_field_toggle($field_toggle) : '' ;
        $data_toggle_name = $field_toggle ? 'data-toggle-name="'.$name.'"' : '';
        $output = '';

        ?>
        <div class="option <?php echo $data_field_toggle; ?>" <?php echo $data_toggle_name; ?> >
            <label><?php echo $label; ?></label>
            <input type="text" name="kjd_background_settings[<?php echo $name;?>]"
            value="<?php echo $wallpaperSettings[$name] ? $wallpaperSettings[$name] : '' ;?>" >
        </div>
        <?php
    }

    private function get_field_toggle($field_toggles){

        $output = 'hide js-toggled-field ';

        foreach ($field_toggles as $field=>$value)
            $output .= $field.' ';


        return $output;
    }

    /**
     * Select field
     * 'args' field is in array - used to populate the options
     * if an 'args' a non-associative array then each value is used for both the value and label
     * otherwise the key is the value and the value is the label. huh?
     * @return [type]       [description]
     */
    public function select_field_generator($args=array()){
        extract($args);

        $classes = '';
        $classes .= $toggle_field ? ' js--toggle-field' : '';
        $data = $toggle_field ? 'data-field-toggle="'.$name.'"' : '';
        ?>
        <div class="option">
            <label><?php echo $label; ?></label>

            <select class="<?php echo $classes ;?>" <?php echo $data;?> name="kjd_background_settings[<?php echo $name; ?>]">
                <?php
                    foreach ($args as $option):
                        $name = strtolower(str_replace(' ','_',$option));
                        $data_targets = $toggle_field[$option] ? 'data-targets="'.$toggle_field[$option].'"' : '';
                ?>
                    <option <?php echo $data_targets; ;?> value="<?php echo $name;?>"
                        <?php selected( $option, "none", true) ?>
                    >
                        <?php echo $option; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <?php

    }

    public function color_field_generator($args=array()){
        extract($args);
        ?>
        <div class="color-field option">

            <label><?php echo $label; ?></label>
            <input class="minicolors opacity" name="kjd_background_settings[<?php echo $name; ?>]"
                value="<?php echo $colorSettings['endcolor'] ? $colorSettings['endcolor'] : 'none'; ?>"

                <?php if( is_string($args) && $args == 'transparency'): ?>
                data-opacity ="<?php echo $end_rgba; ?>"
                <?php endif ?>
            />

            <?php if( is_string($args) && $args == 'transparency'): ?>
            <input  class="rgba-color" name="kjd_background_settings[end_rgba]" type="hidden"
             value="<?php echo $colorSettings['end_rgba'] ? $colorSettings['end_rgba'] : 'none'; ?>" />
            <?php endif; ?>

            <a class="clearColor js--clear-color">Clear</a>
        </div> <!-- End color select-->
        <?php
    }

    public function file_field_generator($args=array()){
        extract($args);
        ?>
        <div class="option">
            <label><?php echo $label; ?></label>
            <input class="media_input"  type="text"  name="kjd_background_settings[<?php echo $name; ?>]"
            value="<?php echo $wallpaperSettings[$name] ? $wallpaperSettings[$name] : ''; ?>" />
            <input class="button upload_image" type="button" value="Upload file" />
        </div>
        <?php
    }


    public function textarea_field_generator(){

    }

    public function label_field_generator(){

    }

}