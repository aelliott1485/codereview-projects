<?php

// Source - https://codereview.stackexchange.com/q/24363/120114
// Posted by jnthnjns, modified by community. See post 'Timeline' for change history
// Retrieved 2026-08-24, License - CC BY-SA 4.0

class Image {
    private $_hex = array();
    private $_size = array();
    private $_topThree = array();
    private $_im, $_mostCommon, $_minDem, $_tempHex, $_uniqueHex;

    public function __construct($image) {
        $ext = explode('.',$image);
        $ext = end($ext);
        if ($ext === 'png') {
            $this->_im = imagecreatefrompng($image);
        } elseif ($ext === 'jpg' || $ext === 'jpeg') {
            $this->_im = imagecreatefromjpeg($image);
        } else {
            die('The supplied extension is not supported. Supported formats include: jpg, jpeg, and png.');
        }
        $this->_size = getimagesize($image);
        $this->setHex();
    }

    public function showAll() {
        foreach($this->_uniqueHex as $k) {
            echo '<div style="background-color:'.$k.'; width:100%; height:30px;">'.$k.'</div>';
        }
    }

    public function getMostCommon() {
        $this->mostCommon($this->_hex);
        return $this->_mostCommon;
    }

    public function getTop() {
        $this->_tempHex = $this->_hex;
        $counted = array_count_values($this->_tempHex);
        arsort($counted);
        $i = 0;
        foreach ($counted as $k => $v) {
            if ($i < 3) {
                $this->_topThree[$i] = $k;
            }
            $i++;
        }
        return $this->_topThree;
    }

    public function showTop() {
        if (empty($this->_topThree)) {
            $this->getTop();
        }
        foreach($this->_topThree as $k) {
            echo '<div style="background-color:'.$k.'; width:100%; height:30px;">'.strtoupper($k).'</div>';
        }
    }

    #########################
    ### PRIVATE FUNCTIONS ###
    #########################
    private function setHex() {
        $x = 0;
        $y = 0;
        $this->_minDem = min($this->_size[0], $this->_size[1]);
        // Get RGB pixel by pixel
        while ($x < $this->_minDem) {
            $colors = imagecolorat($this->_im, $x, $y);
            $r = ($colors >> 16) & 0xFF;
            $g = ($colors >> 8) & 0xFF;
            $b = $colors & 0xFF;
            // Convert RGB to Hex
            $this->_hex[] = $this->toHex($r, $g, $b);
            $x++;
            $y++;
        }
        $this->removeWhiteBlack($this->_hex);
        $this->_uniqueHex = array_unique($this->_hex);
    }

    private function removeWhiteBlack($array) {
        $i = 0;
        foreach($array as $k) {
            $k = strtolower($k);
            if ($k === '#ffffff' || $k === '#000000') {
                unset($this->_hex[$i]);
            }
            $i++;
        }
    }

    private function mostCommon() {
        $counted = array_count_values($this->_hex);
        arsort($counted);
        $this->_mostCommon = key($counted);
    }

    private function toHex($r, $g=-1, $b=-1) {
        (is_array($r) && sizeof($r) == 3) ? list($r, $g, $b) = $r : NULL;
        $r = intval($r); $g = intval($g);
        $b = intval($b);
        $r = dechex($r<0?0:($r>255?255:$r));
        $g = dechex($g<0?0:($g>255?255:$g));
        $b = dechex($b<0?0:($b>255?255:$b));
        $color = (strlen($r) < 2?'0':'').$r;
        $color .= (strlen($g) < 2?'0':'').$g;
        $color .= (strlen($b) < 2?'0':'').$b;
        return '#'.$color;
    }
}
