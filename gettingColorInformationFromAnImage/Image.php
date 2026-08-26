<?php

// Source - https://codereview.stackexchange.com/q/24363/120114
// Updated- applied suggestions from Code review https://codereview.stackexchange.com/a/257275/120114
// Posted by jnthnjns, modified by community. See post 'Timeline' for change history
// Retrieved 2026-08-24, License - CC BY-SA 4.0

class Image
{
    private $_hex = [];
    private $_size = [];
    private $_topThree = [];
    private $_im, $_mostCommon, $_minDem, $_tempHex, $_uniqueHex;

    public function __construct($image)
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type A.K.A. mimetype extension
        $mimeType = finfo_file($finfo, $image);
        if ($mimeType === 'image/png') {
            $this->_im = imagecreatefrompng($image);
        } elseif ($mimeType === 'image/jpg') {
            $this->_im = imagecreatefromjpeg($image);
        } else {
            die('The supplied extension is not supported. Supported formats include: jpg, jpeg, and png.');
        }
        $this->_size = getimagesize($image);
        $this->setHex();
    }

    public function showAll()
    {
        foreach ($this->_uniqueHex as $k) {
            echo '<div style="background-color:' . $k . '; width:100%; height:30px;">' . $k . '</div>';
        }
    }

    public function getMostCommon()
    {
        $this->mostCommon();
        return $this->_mostCommon;
    }

    public function getTop()
    {
        $this->_tempHex = $this->_hex;
        $counted = array_count_values($this->_tempHex);
        arsort($counted);
        $this->_topThree = array_slice(array_keys($counted), 0, 3);
        return $this->_topThree;
    }

    public function showTop()
    {
        if (empty($this->_topThree)) {
            $this->getTop();
        }
        foreach ($this->_topThree as $k) {
            echo '<div style="background-color:' . $k . '; width:100%; height:30px;">' . strtoupper($k) . '</div>';
        }
    }

    #########################
    ### PRIVATE FUNCTIONS ###
    #########################
    private function setHex()
    {
        $x = 0;
        $y = 0;
        $this->_minDem = min($this->_size[0], $this->_size[1]);
        // Get RGB pixel by pixel
        while ($x < $this->_minDem) {
            $colors = imagecolorat($this->_im, $x++, $y++);
            $r = ($colors >> 16) & 0xFF;
            $g = ($colors >> 8) & 0xFF;
            $b = $colors & 0xFF;
            // Convert RGB to Hex
            $hex = sprintf("#%02x%02x%02x", $r, $g, $b);
            if (!in_array(strtolower($hex), ['#ffffff', '#000000'])) {
                $this->_hex[] = $hex;
            }
        }
        $this->_uniqueHex = array_unique($this->_hex);
    }

    private function mostCommon()
    {
        $counted = array_count_values($this->_hex);
        arsort($counted);
        $this->_mostCommon = key($counted);
    }
}
