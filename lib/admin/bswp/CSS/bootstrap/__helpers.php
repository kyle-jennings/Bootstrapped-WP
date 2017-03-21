<?php



/**
 * Sets the background color variables for a component
 */
function _component_background_colors_sass_vars($prefix = null, $settings = array()) {
    if(is_null($prefix) )
        return;

    // $things = array('background_start_color', 'background_end_color', 'background_fill');
    ?>

    $<?php echo $prefix; ?>BackgroundColor: <?php echo $settings['background_start_color_rgba'] ? $settings['background_start_color_rgba'] : '$bodyBackground'; ?> !default;
    $<?php echo $prefix; ?>BackgroundEndColor: <?php echo $settings['background_end_color_rgba'] ? $settings['background_end_color_rgba'] : '$bodyBackgroundEnd'; ?> !default;

    $<?php echo $prefix; ?>BackgroundFill: <?php echo $settings['background_fill'] ? $settings['background_fill'] : 'none'; ?> !default;
<?php
}


/**
 * Set the border radius
 */
function _component_border_radius_sass_vars($prefix = null, $borders = array()){
?>
    $<?php echo $prefix; ?>BorderRadius: <?php echo $borders['all_corners'] ? $borders['all_corners'] :'$baseBorderRadius' ; ?> !default;

    <?php
    if(is_null($prefix) || empty($borders) )
        return;

    $corners = array('top_left','top_right','bottom_right', 'bottom_left');
    ?>

    <?php
        foreach($corners as $corner):
            $cornerName = str_replace(' ','',ucwords(str_replace('_',' ',$corner)));
    ?>
        $<?php echo $prefix.$cornerName; ?>BorderRadius: <?php echo $borders[$corner] ? $borders[$corner] :'$baseBorderRadius' ; ?> !default;
    <?php endforeach; ?>

    <?php if($borders['style_corners'] == 'yes'):?>
        $<?php echo $prefix; ?>BorderRadius: $<?php echo $prefix?>TopLeftBorderRadius $<?php echo $prefix?>TopRightBorderRadius $<?php echo $prefix?>BottomRightBorderRadius $<?php echo $prefix?>BottomLeftBorderRadius;
    <?php endif;
}


/**
 * Set the borders for a component
 */
function _component_outer_border_sass_vars($prefix = null, $borders = array(), $defaults = array()){
    $count = 0;
?>
    $<?php echo $prefix; ?>BorderColor: <?php echo _tern( $borders['all_sides_border_color'], 'rgba(0, 0, 0, 0.2)'); ?> !default;
    $<?php echo $prefix; ?>BorderStyle: <?php echo _tern( $borders['all_sides_border_style'], 'solid'); ?> !default;
    $<?php echo $prefix; ?>BorderWidth: <?php echo _tern( $borders['all_sides_border_width'], '1px'); ?> !default;

<?php
    if(is_null($prefix) || empty($borders) )
        return;

    $sides = array('top','right','bottom', 'left');
?>


    <?php foreach($sides as $side): ?>

    $<?php echo $prefix; ?><?php echo ucfirst($side);?>BorderColor: <?php echo _tern($borders[$side.'_border_color'], 'transparent'); ?> !default;
    $<?php echo $prefix; ?><?php echo ucfirst($side);?>BorderStyle: <?php echo _tern($borders[$side.'_border_style'], 'none'); ?> !default;
    $<?php echo $prefix; ?><?php echo ucfirst($side);?>BorderWidth: <?php echo _tern($borders[$side.'_border_width'], '0'); ?> !default;
    <?php endforeach; ?>

    <?php if($borders['style_border_sides'] == 'yes'): ?>
        $<?php echo $prefix; ?>BorderColor:
            $<?php echo $prefix; ?>TopBorderColor
            $<?php echo $prefix; ?>RightBorderColor
            $<?php echo $prefix; ?>BottomBorderColor
            $<?php echo $prefix; ?>LeftBorderColor;
        $<?php echo $prefix; ?>BorderStyle:
            $<?php echo $prefix; ?>TopBorderStyle
            $<?php echo $prefix; ?>RightBorderStyle
            $<?php echo $prefix; ?>BottomBorderStyle
            $<?php echo $prefix; ?>LeftBorderStyle;
        $<?php echo $prefix; ?>BorderWidth:
            $<?php echo $prefix; ?>TopBorderWidth
            $<?php echo $prefix; ?>RightBorderWidth
            $<?php echo $prefix; ?>BottomBorderWidth
            $<?php echo $prefix; ?>LeftBorderWidth;
    <?php
    endif;

}


/**
 * function to set the link styles for a component (they are all on the same page)
 *
 *    $componentLinkColor
 *    $componentLinkBackgroundStyle
 *    $componentLinkBackgroundColor
 *    $componentLinkTextDecpration
 *    $componentLinkTextShadow
 *    $componentHoveredLinkTextShadow
 *    ...
 */
function _component_links_sass_vars($prefix = null, $links = array()) {

?>
$<?php echo $prefix ?>LinkColor: $linkColor;

<?php
    if(is_null($prefix) )
        return;

    $states = array('link','hovered_link', 'active_link', 'visited_link');

    foreach($states as $state):
        // removes the underscore and StudyCases the link type
        // hovered_link => HoveredLink
        $state_name = $prefix . str_replace(' ','',ucwords(str_replace('_',' ',$state)));
        $default = $prefix.'LinksColor';

    ?>

    $<?php echo $state_name; ?>Color: <?php echo _tern($links[$state.'_color'],'$'.$prefix.'LinkColor'); ?> !default;

    $<?php echo $state_name; ?>BackgroundStyle: <?php echo _tern($links[$state.'_background_style'],'none'); ?> !default;
    $<?php echo $state_name; ?>BackgroundColor: <?php echo _tern($links[$state.'_background_color_rgba'],'transparent'); ?> !default;
    $<?php echo $state_name; ?>TextDecoration: <?php echo _tern($links[$state.'_text_decoration'],'none'); ?> !default;
    $<?php echo $state_name; ?>TextShadow: <?php echo _tern($links[$state.'_text_shadow'],'none'); ?> !default;


    <?php

    endforeach;

}


function _tern($try, $default) {
    return $try ? $try : $default;

}


function _default($fallback, $default = null, &$count = 0) {
    if(!$fallback)
        return '';

    $count ++;
    return $default ? $default : $fallback;

}
