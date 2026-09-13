<?php

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/convertIntegerToRomanNumeral.php';

final class RomanNumeralTest extends TestCase
{
    #[DataProvider('numberProvider')]
    public function testNum2RomanNumeralConvertsIntegerToRomanNumeral(int $number, string $expected): void
    {
        $output = num2RomanNumeral($number);

        $this->assertSame($expected, $output);
    }

    /**
     * @return array<string, array{int, string}>
     */
    public static function numberProvider(): array
    {
        return [
            'zero converts to nothing' => [0, ''],
            'one' => [1, 'I'],
            'three repeats the unit' => [3, 'III'],
            'four subtracts' => [4, 'IV'],
            'five' => [5, 'V'],
            'nine subtracts' => [9, 'IX'],
            'ten' => [10, 'X'],
            'fourteen' => [14, 'XIV'],
            'forty subtracts' => [40, 'XL'],
            'forty-nine uses two subtractions' => [49, 'XLIX'],
            'fifty' => [50, 'L'],
            'ninety subtracts' => [90, 'XC'],
            'ninety-nine uses two subtractions' => [99, 'XCIX'],
            'one hundred' => [100, 'C'],
            'four hundred subtracts' => [400, 'CD'],
            'five hundred' => [500, 'D'],
            'nine hundred subtracts' => [900, 'CM'],
            'one thousand' => [1000, 'M'],
            'every numeral in one number' => [1666, 'MDCLXVI'],
            'a year' => [1987, 'MCMLXXXVII'],
            'another year' => [2024, 'MMXXIV'],
            'longest numeral under four thousand' => [3888, 'MMMDCCCLXXXVIII'],
            'largest conventional numeral' => [3999, 'MMMCMXCIX'],
            'above three thousand nine hundred ninety-nine the M simply repeats' => [4212, 'MMMMCCXII'],
        ];
    }
}
