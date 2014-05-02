<?php

    require 'GridMethodImage.php';
    
    // Grab the request body and decode the json data
    $file = $_FILES[0];
    
    // Use the rgb paramater if it was passed as an array
    if (is_array($params[rgb])) {
        $rgb = $_REQUEST['rgb']; // array(0, 0, 0);
    } else {
        $rgb = array(0, 0, 0);
    }
    
    // Use the divisions value if it was passed
    if (!empty($_REQUEST['divisions'])) {
        $divisions = $_REQUEST['divisions'];
    } else {
        $divisions = 2;
    }
    
    // Grab the file
    if (!empty($_FILES['file']['tmp_name'])) {
        $filename = $_FILES['file']['tmp_name'];
    } else {
        die('Error: Invalid image.');
    }

    // Process the image
    $image = new GridMethodImage($filename, $divisions, $rgb);
    
    // Output it
    header('Content-type: image/jpeg');
    imagejpeg($image->image, null, 90);

?>
