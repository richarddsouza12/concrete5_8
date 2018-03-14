<?php


/** @var \Concrete\Core\File\Image\BasicThumbnailer $ih */
$ih = Core::make('helper/image');
$page = \Concrete\Core\Page\Page::getByID('216');
/** @var DoctrineProxies\__CG__\Concrete\Core\Entity\File\File  $img */
$img = $page->getAttribute('banner_image');

echo "<pre>";
var_dump($img);
die;
    echo "<pre>";
    var_dump(get_class());
// Image Library
    try {
        // Create a new SimpleImage object
        $image = new \claviska\SimpleImage();
        $image
            ->fromFile($img)                         // load image.jpg
            ->autoOrient()                              // adjust orientation based on exif data
            ->resize(100, 100)
            ->toFile('new-image.png', 'image/png');
    } catch(Exception $err) {
        // Handle errors
        echo $err->getMessage();
    }

    die();
    $thumb = $ih->getThumbnail($img, 100, 100, false);
    $src= $thumb->src;

    echo "<img src='{$src}' />";
    die;


// Image Library
    try {
        // Create a new SimpleImage object
        $image = new \claviska\SimpleImage();
    $image
        ->fromFile('application/tools/image.jpg')   // load image.jpg
        ->autoOrient()                              // adjust orientation based on exif data
        ->resize(320, 200)                          // resize to 320x200 pixels
        ->flip('x')                                 // flip horizontally
        ->colorize('DarkBlue')                      // tint dark blue
        ->border('black', 10)                       // add a 10 pixel black border
       /* ->overlay('watermark.png', 'bottom right')*/  // add a watermark image
        ->toFile('new-image.png', 'image/png');     // convert to PNG and save a copy to new-image.png
        /*->toScreen();  */                             // output to the screen

        echo "success - see the root folder for image";

} catch(Exception $err) {
    // Handle errors
    echo $err->getMessage();
}

?>