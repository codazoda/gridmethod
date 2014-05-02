<?php

class GridMethodImage {
    
    public $image;
    public $width;
    public $height;
    public $color;
    
    public function __construct($imageFilename, $divisions, $rgbColor = array(255,255,255)) {
        $this->image = $this->loadImage($imageFilename);
        $this->width = imagesx($this->image);
        $this->height = imagesy($this->image);
        $this->color = imagecolorallocate($this->image, $rgbColor[0], $rgbColor[1], $rgbColor[2]);
        $this->drawLines($divisions);
    }

    private function loadImage($imageName) {
        $image = imagecreatefromjpeg($imageName);
        return $image;
    }
    
    private function drawLines($divisions) {
        
        // Initialize variables
        $currentXLinePosition = 0;
        $currentYLinePosition = 0;
        
        // We need one less line than divisions
        $lines = $divisions - 1;
        
        // Take width/height of image, subtract a pixel for each line, divide by divisions
        $xSpaceSize = ($this->width - $lines) / $divisions;
        $ySpaceSize = ($this->height - $lines) / $divisions;
        
        // Loop through the lines drawing them
        for($i=0;$i<$divisions;$i++) {
            // Calculate where this line goes
            $currentXLinePosition = round( $currentXLinePosition + $xSpaceSize + 1 );
            $currentYLinePosition = round( $currentYLinePosition + $ySpaceSize + 1 );
            // Draw the vertical line
            imageline($this->image, $currentXLinePosition, 0, $currentXLinePosition, $this->height, $this->color);
            // Draw the horizontal line
            imageline($this->image, 0, $currentYLinePosition, $this->width, $currentYLinePosition, $this->color);
        }

    }
        
}

?>
