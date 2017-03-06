/*!
 * Bootstrap v2.3.2
 *
 * Copyright 2012 Twitter, Inc
 * Licensed under the Apache License v2.0
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Designed and built with all the love in the world @twitter by @mdo and @fat.
 */

// Core variables and mixins
@import "bootstrap/variables"; // Modify this for custom colors, font-sizes, etc
@import "bootstrap/mixins";

// CSS Reset
@import "bootstrap/reset";

// Grid system and page structure
@import "bootstrap/scaffolding";
@import "bootstrap/grid";
@import "bootstrap/layouts";

// Base CSS
@import "bootstrap/type";
@import "bootstrap/blockquotes";
@import "bootstrap/code";
@import "bootstrap/forms";
@import "bootstrap/tables";

// Components: common
@import "bootstrap/sprites";
@import "bootstrap/dropdowns";
@import "bootstrap/wells";
@import "bootstrap/component-animations";
@import "bootstrap/close";

// Components: Buttons & Alerts
@import "bootstrap/buttons";
@import "bootstrap/button-groups";
@import "bootstrap/alerts"; // Note: alerts share common CSS with buttons and thus have styles in buttons

// Components: Nav
@import "bootstrap/navs";
@import "bootstrap/navbar";
@import "bootstrap/navbar_dropdown";

@import "bootstrap/brand";
@import "bootstrap/navbar-toggle";


@import "bootstrap/breadcrumbs";
@import "bootstrap/pagination";
@import "bootstrap/pager";

// Components: Popovers
@import "bootstrap/modals";
@import "bootstrap/tooltip";
@import "bootstrap/popovers";

// images
@import "bootstrap/images";
// @import "bootstrap/thumbnails";
@import "bootstrap/thumbnails";


// Components: Misc
@import "bootstrap/media";
@import "bootstrap/labels-badges";
@import "bootstrap/progress-bars";
@import "bootstrap/accordion";
@import "bootstrap/tabbables";
@import "bootstrap/carousel";
@import "bootstrap/hero-unit";

// Utility classes
@import "bootstrap/utilities"; // Has to be last to override when necessary


/*!
 * Bootstrap Responsive v2.3.2
 *
 * Copyright 2012 Twitter, Inc
 * Licensed under the Apache License v2.0
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Designed and built with all the love in the world @twitter by @mdo and @fat.
 */


// Responsive
// For phone and tablet devices
// -------------------------------------------------------------


// REPEAT VARIABLES & MIXINS
// -------------------------
// Required since we compile the responsive stuff separately

@import "bootstrap/variables"; // Modify this for custom colors, font-sizes, etc
@import "bootstrap/mixins";


// RESPONSIVE CLASSES
// ------------------

@import "bootstrap/responsive-utilities";


// MEDIA QUERIES
// ------------------

// Large desktops
@import "bootstrap/responsive-1200px-min";

// Tablets to regular desktops
@import "bootstrap/responsive-768px-979px";

// Phones to portrait tablets and narrow desktops
@import "bootstrap/responsive-767px-max";


// RESPONSIVE NAVBAR
// ------------------

// From 979px and below, show a button to toggle navbar contents
@import "bootstrap/responsive-navbar";
