<?php


// background settings
$background = $this->values['background'];
$background_colors = $background['colors'];
$background_wallpapers = $background['wallpapers'];

// border settings
$borders = $this->values['borders'];

// headings

$headings = $this->values['headings'];
// text and links
$text = $this->values['text'];
$text_color = $text['text']['text_color'];

$links = array(
    'links' => $text['links'],
    'hovered_links' => $text['hovered-links'],
    'visited_links' => $text['visited-links'],
    'active_links' => $text['active-links'],
);

// tables
$tables = $this->values['tables'];
// examine($tables);


// navbar
$navbar = $this->values['navbar'];
$navbg = $navbar['background_colors'];
$navtext = $navbar['text'];
$navborders = $nav['borders'];

$nav_submenu_bg = $navbar['submenu_background_colors'];
$nav_submenu_text = $navbar['submenu_text'];
$nav_submenu_border = $navbar['submenu_borders'];

// examine($nav_submenu_border);
ob_start();
?>

//
// Variables
// --------------------------------------------------
@function image-path($file) {
  @return "../img/"+$file
}

// Global values
// --------------------------------------------------


// Grays
// -------------------------
$black:                 #000 !default;
$grayDarker:            #222 !default;
$grayDark:              #333 !default;
$gray:                  #555 !default;
$greyMedium:            #777 !default;
$grayLight:             #999 !default;
$grayLighter:           #eee !default;
$white:                 #fff !default;


// Accent colors
// -------------------------
$blue:                  #049cdb !default;
$blueDark:              #0064cd !default;
$green:                 #46a546 !default;
$red:                   #9d261d !default;
$yellow:                #ffc40d !default;
$orange:                #f89406 !default;
$pink:                  #c3325f !default;
$purple:                #7a43b6 !default;


<?php

require_once '_scaffolding.php';
?>


// Links
// -------------------------
<?php

require_once '_links.php';

?>

$linkColorHover:        darken($hoveredlinksColor, 15%) !default;
// Typography
// -------------------------
$sansFontFamily:        "Helvetica Neue", Helvetica, Arial, sans-serif !default;
$serifFontFamily:       Georgia, "Times New Roman", Times, serif !default;
$monoFontFamily:        Monaco, Menlo, Consolas, "Courier New", monospace !default;

$baseFontSize:          14px !default;
$baseFontFamily:        $sansFontFamily !default;
$baseLineHeight:        20px !default;
$altFontFamily:         $serifFontFamily !default;

$headingsFontFamily:    inherit !default; // empty to use BS default, $baseFontFamily
$headingsFontWeight:    bold !default;    // instead of browser default, bold

<?php

    require_once '_headings.php';
?>


// Component sizing
// -------------------------
// Based on 14px font-size and 20px line-height

$fontSizeLarge:         $baseFontSize * 1.25; // ~18px
$fontSizeSmall:         $baseFontSize * 0.85; // ~12px
$fontSizeMini:          $baseFontSize * 0.75; // ~11px

$paddingLarge:          11px 19px !default; // 44px
$paddingSmall:          2px 10px !default;  // 26px
$paddingMini:           0px 6px !default;   // 22px

$baseBorderRadius:      4px !default;
$borderRadiusLarge:     6px !default;
$borderRadiusSmall:     3px !default;


<?php
    require_once '_tables.php';
    require_once '_buttons.php';
    require_once '_forms.php';
?>






// Dropdowns
// -------------------------
$dropdownBackground:            $white !default;
$dropdownBorder:                rgba(0,0,0,.2) !default;
$dropdownDividerTop:            #e5e5e5 !default;
$dropdownDividerBottom:         $white !default;

$dropdownLinkColor:             $grayDark !default;
$dropdownLinkColorHover:        $white !default;
$dropdownLinkColorActive:       $white !default;

$dropdownLinkBackgroundActive:  $linkColor !default;
$dropdownLinkBackgroundHover:   $dropdownLinkBackgroundActive !default;



// COMPONENT VARIABLES
// --------------------------------------------------


// Z-index master list
// -------------------------
// Used for a bird's eye view of components dependent on the z-axis
// Try to avoid customizing these :)
$zindexDropdown:          1000 !default;
$zindexPopover:           1010 !default;
$zindexTooltip:           1030 !default;
$zindexFixedNavbar:       1030 !default;
$zindexModalBackdrop:     1040 !default;
$zindexModal:             1050 !default;


// Sprite icons path
// -------------------------
$iconSpritePath:          image-path("glyphicons-halflings.png") !default;
$iconWhiteSpritePath:     image-path("glyphicons-halflings-white.png") !default;


// Input placeholder text color
// -------------------------
$placeholderText:         $grayLight !default;


// Hr border color
// -------------------------
$hrBorder:                $grayLighter !default;


// Horizontal forms & lists
// -------------------------
$horizontalComponentOffset:       180px !default;


// Wells
// -------------------------
$wellBackground:                  #f5f5f5 !default;


// Navbar
// -------------------------
$navbarCollapseWidth:             979px !default;
$navbarCollapseDesktopWidth:      $navbarCollapseWidth + 1;

<?php

require_once '_navbar.php';
require_once '_navbar-dropdown.php';
require_once '_pagination.php';
require_once '_collapsibles.php';
require_once '_hero-unit.php';
require_once '_tabs.php';
require_once '_alerts.php';
require_once '_tooltips.php';
require_once '_quotes.php';
require_once '_preformatted.php';
require_once '_well.php';

?>





// popovers
// -------------------------

$popoverBackground:       #fff !default;
$popoverArrowWidth:       10px !default;
$popoverArrowColor:       #fff !default;
$popoverTitleBackground:  darken($popoverBackground, 3%) !default;

// Special enhancement for popovers
$popoverArrowOuterWidth:  $popoverArrowWidth + 1 !default;
$popoverArrowOuterColor:  rgba(0,0,0,.25) !default;



// GRID
// --------------------------------------------------


// Default 940px grid
// -------------------------
$gridColumns:             12 !default;
$gridColumnWidth:         60px !default;
$gridGutterWidth:         20px !default;
$gridRowWidth:            ($gridColumns * $gridColumnWidth) + ($gridGutterWidth * ($gridColumns - 1)) !default;

// 1200px min
$gridColumnWidth1200:     70px !default;
$gridGutterWidth1200:     30px !default;
$gridRowWidth1200:        ($gridColumns * $gridColumnWidth1200) + ($gridGutterWidth1200 * ($gridColumns - 1)) !default;

// 768px-979px
$gridColumnWidth768:      42px !default;
$gridGutterWidth768:      20px !default;
$gridRowWidth768:         ($gridColumns * $gridColumnWidth768) + ($gridGutterWidth768 * ($gridColumns - 1)) !default;


// Fluid grid
// -------------------------
$fluidGridColumnWidth:    percentage($gridColumnWidth/$gridRowWidth) !default;
$fluidGridGutterWidth:    percentage($gridGutterWidth/$gridRowWidth) !default;

// 1200px min
$fluidGridColumnWidth1200:     percentage($gridColumnWidth1200/$gridRowWidth1200) !default;
$fluidGridGutterWidth1200:     percentage($gridGutterWidth1200/$gridRowWidth1200) !default;

// 768px-979px
$fluidGridColumnWidth768:      percentage($gridColumnWidth768/$gridRowWidth768) !default;
$fluidGridGutterWidth768:      percentage($gridGutterWidth768/$gridRowWidth768) !default;


<?php
$contents = ob_get_contents();
ob_end_clean();
// examine($contents);
$this->bootstrap_vars = $contents;