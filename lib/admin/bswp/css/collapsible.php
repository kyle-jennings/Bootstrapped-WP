<?php

namespace bswp\css;

class collapsible {
    public $collapsible_content_background;
    public $collapsible_content_background_rgba;
    public $collapsible_content_border;
    public $collapsible_content_text_color;
    public $collapsible_content_link_color;

    public $collapsible_active_tab_border;
    public $collapsible_active_tab_background;
    public $collapsible_active_tab_background_rgba;
    public $collapsible_active_tab_link_color;

    public $collapsible_inactive_tab_border;
    public $collapsible_inactive_tab_background;
    public $collapsible_inactive_tab_background_rgba;
    public $collapsible_inactive_tab_link_color;

    public $collapsible_hovered_tab_background;
    public $collapsible_hovered_tab_background_rgba;
    public $collapsible_hovered_tab_border;
    public $collapsible_hovered_tab_link_color;

    public $parts;
    public $section;

    public $output = '';

    // magic methods

    public function __construct( $args = array(), $section ){

        $this->section = $section;
        $this->parts = array('content', 'inactive_tab', 'hovered_tab');
        if(!is_array($args))
            return false;

        $this->set_values($args);
        $this->set_defaults();
    }

    public function __toString(){
        return $this->output;
    }

    // custom methods

    public function add_breaklines(){

        $first_char = $this->output[0];
        $this->output = "\n\t".$this->output;
        $this->output = str_replace(';', "; \n\t", $this->output);
        $this->output = rtrim($this->output, "\t");
    }


    public function set_values($args = array()){


        if( empty($args) )
            return false;

        foreach($args as $k=>$v){
            $this->$k = $v;
        }

    }



    private function set_defaults(){
        //active tab and content area

        foreach($this->parts as $part){

            $background = 'collapsible_'.$part.'_background';
            $background_rgba = 'collapsible_'.$part.'_background_rgba';
            $border_color = 'collapsible_'.$part.'_border';
            $text_color = 'collapsible_'.$part.'_text_color';
            $link_color = 'collapsible_'.$part.'_link_color';

            $this->$background = !empty($this->$background) ? $this->$background : null;
            $this->$background_rgba = !empty($this->$background_rgba) ? $this->$background_rgba : $this->$background;
            $this->$border_color = !empty($this->$border_color) ? $this->$border_color : $this->$background_rgba;

            $this->$link_color = !empty($this->$link_color) ? $this->$link_color : null;

            if($part == 'content')
                $this->$text_color = !empty($this->$text_color) ? $this->$text_color : null;

        }


    }


    public function content_area_styles(){

        $output = '';

        // setup defaults
        $content_background = $this->collapsible_content_background_rgba;
        $content_border = $this->collapsible_content_border;
        $content_text = $this->collapsible_content_text_color;
        $content_link = $this->collapsible_content_link_color;


        // the active tab SHOULD match the content area styles tbh, so this should
        // be killed in the future, but this is a lift and shift

        if( empty($content_background) &&
            empty($content_border) &&
            empty($content_text)
        )
        return;


        // the content area
        $output .= $section.' .tabbable > .tab-content{';
            if(!empty($content_background))
                $output .= 'background:'. $content_background.'; ';
            if(!empty($content_border))
                $output .= 'border-color:'. $content_border.'; ';
            if(!empty($content_text))
                $output .= 'color:'. $content_text.';';

            $output .= 'border-style: solid; border-width: 1px; padding:20px;';
        $output .= '}';

        $this->output .= $output;
    }



    public function title_styles($target){


        $background_rgba = 'collapsible_'.$target.'_background_rgba';
        $border_color = 'collapsible_'.$target.'_border';
        $link_color = 'collapsible_'.$target.'_link_color';

        $background_rgba = $this->$background_rgba;
        $border_color = $this->$border_color;
        $link_color = $this->$link_color;

        $selector = $this->get_title_selector($target);
        if($selector == false)
            return;


        // the active tab SHOULD match the content area styles tbh, so this should
        // be killed in the future, but this is a lift and shift

        if( empty($background_rgba) &&
            empty($border_color) &&
            empty($link_color)
        )
        return;

        $output = '';
        $output .= $selector . ' {';
            if(!empty($background_rgba))
            $output .= 'background:'. $background_rgba.';';
            if(!empty($border_color)){
                $output .= 'border-bottom-color: '. $border_color.' ; ';
            }
            if(!empty($link_color))
                $output .= 'color:'. $link_color.';';

        $output .= '}';

        $this->output .= $output;
    }


    public function get_title_selector($target){
        switch($target):
            case 'active_title':
                return $this->section.' .tabbable > ul.nav > li.active > a';
                break;
            case  'inactive_title':
                return $section.' .tabbable > ul.nav > li > a';
                break;
            case 'hovered_title':
                return $this->section.' .tabbable > ul.nav > li > a:hover';
                break;
        endswitch;

        return false;
    }
}
