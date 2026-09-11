<?php

// Source - https://codereview.stackexchange.com/q/279873
// Posted by ieatredcrayons, modified by community. See post 'Timeline' for change history
// Retrieved 2026-09-10, License - CC BY-SA 4.0

    $NumberRomanNumeral = array(
        1 => array(
            "RomanNumeral" => "I",
            "NearestNum" => null
        ),
        5 => array(
            "RomanNumeral" => "V",
            "NearestNum" => 4
        ),
        10 => array(
            "RomanNumeral" => "X",
            "NearestNum" => 9
        ),
        50 => array(
            "RomanNumeral" => "L",
            "NearestNum" => 40
        ),
        100 => array(
            "RomanNumeral" => "C",
            "NearestNum" => 90
        ),
        500 => array(
            "RomanNumeral" => "D",
            "NearestNum" => 400
        ),
        1000 => array(
            "RomanNumeral" => "M",
            "NearestNum" => 900
        ),
    );

    function separateNumberIntoUnits($n) {
        $separated = str_split($n,1);
        for ($i = 0;$i <= count($separated)-1; $i++){
            $currentNum = $separated[$i];
            $length = count($separated) - $i;
            $separated[$i] = str_pad($currentNum, $length, "0");
        }
        return $separated;
    }

    function getClosestNum($numToFind){
        //echo($numToFind);
        global $NumberRomanNumeral;
        $closestNum = null;
        $foundKey = null;
        $closestMag = null;
        $differenceArray = array();
        $numLeft = null;
        if ($numToFind == 0) {
            return null;
        }
        foreach($NumberRomanNumeral as $num => $data){
            array_push($differenceArray, $data["NearestNum"]);
        }
        foreach($NumberRomanNumeral as $num => $data){
            $currentIndex = array_search($num,array_keys($NumberRomanNumeral));
            $romanNumeral = $data["RomanNumeral"];
            $differenceToSum = $data["NearestNum"];
            $previousDifferenceToSum = null;

            if ($num != 1){
                $previousDifferenceToSum = $differenceArray[$currentIndex-1];
            }
            $mag = $num - $numToFind;
            if ($mag < 0){
                $mag *= -1;
            }
            if ($numToFind == $num){
                $closestNum = $num;
                $foundKey = $romanNumeral;
                break;
            }elseif($numToFind == $differenceToSum){
                $closestNum = $num;
                $foundKey = $romanNumeral;
                break;
            }
            if ($closestMag == null){
                $closestNum = $num;
                $closestMag = $mag;
                $foundKey = $romanNumeral;
            } else {
                if ($mag < $closestMag && $mag > $previousDifferenceToSum) {
                    $closestNum = $num;
                    $closestMag = $mag;
                    $foundKey = $romanNumeral;
                }
            }
        }
        $numLeft = $numToFind - $closestNum;
        if ($numLeft < 0){
            $numLeft *= -1;
        }
        return array($closestNum, $foundKey, $numLeft);
    }

    function num2RomanNumeral($num, &$string){
        if ($num != null || $num != 0){
            $numArray = separateNumberIntoUnits($num);
            foreach($numArray as $splitNum){
                $data = getClosestNum($splitNum);
                if ($data != null){
                    $closestNumber = $data[0];
                    $foundRomanNumeral = $data[1];
                    $numLeft = $data[2];
                    if ($splitNum > $closestNumber){
                        $string = $string.$foundRomanNumeral;
                        if ($numLeft > 0){
                            num2RomanNumeral($numLeft, $string);
                        }
                    }elseif($splitNum < $closestNumber){
                        if ($numLeft > 0){
                            num2RomanNumeral($numLeft, $string);
                        }
                        $string = $string.$foundRomanNumeral;
                    }else{
                        if ($numLeft > 0){
                            num2RomanNumeral($numLeft, $string);
                        }
                        $string = $string.$foundRomanNumeral;
                    }

                }
            }
        }
    }

    $romanNumeralText = "";

    num2RomanNumeral(4212, $romanNumeralText);

    echo $romanNumeralText;

?>
