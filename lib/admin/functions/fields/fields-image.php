<?php

/**
 * All images are basically the same, some need a couple settings removed
 * @var array
 */
$image_types = array('thumbnails', 'inline_images','caption','iframe');
$images = array();

// The image types are all basically the same, so lets set the all at once
foreach($image_types as $image){
    $images[$image] = array(
        'label'=>ucfirst(str_replace('_',' ',$image)),
        'fields'=>array(
            'background_color'=>color_field(
                    array(
                        'name'=>'color',
                        'label'=>'Start Color',
                        'args'=>'transparency'
                    )
                ),
            'border_color'=>color_field(
                    array(
                        'name'=>'color',
                        'label'=>'Start Color',
                    )
                ),
            'hover_glow'=>color_field(
                    array(
                        'name'=>'color',
                        'label'=>'Start Color',
                        'args'=>'transparency'
                    )
                ),
            'text_color'=>color_field(
                    array(
                        'name'=>'color',
                        'label'=>'Start Color',
                    )
                ),
            'border_size'=>select_field(
                    array(
                            'name'=>'border_size',
                            'args'=>array_map('add_px_string', range(1,20))
                        )
                ),
            'border_style'=>select_field(
                    array(
                            'name'=>'border_style',
                            'args'=>array_map('add_px_string', range(1,20))
                        )
                ),
            'border_radius'=>select_field(
                    array(
                            'name'=>'border_radius',
                            'args'=>array_map('add_px_string', range(1,20))
                        )
                )
        ),
    );

    // some fields are removed for specific image types
    if($image != 'captions')
        unset($images[$image]['fields']['text_color']);
    if(in_array($image, array('images','iframe')))
        unset($images[$image]['fields']['hover_glow']);

}

$images_fields = array(
    'section'=>'images',
    'tabs'=>$images
);
