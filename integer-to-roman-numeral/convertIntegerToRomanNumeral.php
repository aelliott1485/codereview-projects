<?php

// Source - https://codereview.stackexchange.com/q/279873
// Posted by ieatredcrayons, modified by community. See post 'Timeline' for change history
// Retrieved 2026-09-10, License - CC BY-SA 4.0

define('NUMER_ROMAN_NUMERAL_MAPPING', [
    1 => [
        'RomanNumeral' => 'I',
        'NearestNum' => null
    ],
    5 => [
        'RomanNumeral' => 'V',
        'NearestNum' => 4
    ],
    10 => [
        'RomanNumeral' => 'X',
        'NearestNum' => 9
    ],
    50 => [
        'RomanNumeral' => 'L',
        'NearestNum' => 40
    ],
    100 => [
        'RomanNumeral' => 'C',
        'NearestNum' => 90
    ],
    500 => [
        'RomanNumeral' => 'D',
        'NearestNum' => 400
    ],
    1000 => [
        'RomanNumeral' => 'M',
        'NearestNum' => 900
    ],
]);

function separateNumberIntoUnits($n)
{
    $separated = str_split($n);
    foreach ($separated as $i => $currentNum) {
        $length = count($separated) - $i;
        $separated[$i] = str_pad($currentNum, $length, '0');
    }
    return $separated;
}

function getClosestNum($numToFind): ?array
{
    $closestNum = null;
    $foundKey = null;
    $closestMag = null;
    $differenceArray = array_column(NUMER_ROMAN_NUMERAL_MAPPING, 'NearestNum');
    if ($numToFind == 0) {
        return null;
    }
    foreach (NUMER_ROMAN_NUMERAL_MAPPING as $num => $data) {
        $currentIndex = array_search($num, array_keys(NUMER_ROMAN_NUMERAL_MAPPING));
        $romanNumeral = $data["RomanNumeral"];
        $differenceToSum = $data["NearestNum"];
        $previousDifferenceToSum = null;

        if ($num != 1) {
            $previousDifferenceToSum = $differenceArray[$currentIndex - 1];
        }
        $mag = $num - $numToFind;
        if ($mag < 0) {
            $mag *= -1;
        }
        if ($numToFind == $num) {
            $closestNum = $num;
            $foundKey = $romanNumeral;
            break;
        } elseif ($numToFind == $differenceToSum) {
            $closestNum = $num;
            $foundKey = $romanNumeral;
            break;
        }
        if ($closestMag == null) {
            $closestNum = $num;
            $closestMag = $mag;
            $foundKey = $romanNumeral;
        } else if ($mag < $closestMag && $mag > $previousDifferenceToSum) {
            $closestNum = $num;
            $closestMag = $mag;
            $foundKey = $romanNumeral;
        }
    }
    $numLeft = $numToFind - $closestNum;
    if ($numLeft < 0) {
        $numLeft *= -1;
    }
    return [$closestNum, $foundKey, $numLeft];
}

function num2RomanNumeral(int $num): string
{
    $output = '';
    if ($num != null || $num != 0) {
        $numArray = separateNumberIntoUnits($num);
        foreach ($numArray as $splitNum) {
            $data = getClosestNum($splitNum);
            if (is_array($data) && count($data) > 2) {
                [$closestNumber, $foundRomanNumeral, $numLeft] = $data;
                if ($splitNum > $closestNumber) {
                    $output .= $foundRomanNumeral;
                    if ($numLeft > 0) {
                        $output .= num2RomanNumeral($numLeft);
                    }
                } elseif ($splitNum < $closestNumber) {
                    if ($numLeft > 0) {
                        $output .= num2RomanNumeral($numLeft);
                    }
                    $output .= $foundRomanNumeral;
                } else {
                    if ($numLeft > 0) {
                        $output .= num2RomanNumeral($numLeft);
                    }
                    $output .= $foundRomanNumeral;
                }
            }
        }
    }
    return $output;
}
