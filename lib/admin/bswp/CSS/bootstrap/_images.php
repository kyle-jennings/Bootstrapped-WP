


// Images
///////////////////////

$imagePadding: <?php echo $image_captions['padding'] ? $image_captions['padding'] : '0px' ;?> !default;
<?php

    _component_background_colors_sass_vars('image', $images);
    _component_outer_border_sass_vars('image', $images);
    _component_border_radius_sass_vars('image', $images);

?>


// caption images
//////////////////

$imageCaptionTextColor: <?php echo $image_captions['text_color'] ? $image_captions['text_color'] : '$textColor' ;?> !default;
$imageCaptionPadding: <?php echo $image_captions['padding'] ? $image_captions['padding'] : '0px' ;?> !default;
<?php

    _component_background_colors_sass_vars('imageCaption', $image_captions);
    _component_outer_border_sass_vars('imageCaption', $image_captions);
    _component_border_radius_sass_vars('imageCaption', $image_captions);

?>


// thumbnail images
/////////////////////
$imageThumbnailPadding: <?php echo $image_thumbnails['padding'] ? $image_captions['padding'] : '0px' ;?> !default;
<?php

    _component_background_colors_sass_vars('imageThumbnail', $image_thumbnails);
    _component_outer_border_sass_vars('imageThumbnail', $image_thumbnails);
    _component_border_radius_sass_vars('imageThumbnail', $image_thumbnails);

?>