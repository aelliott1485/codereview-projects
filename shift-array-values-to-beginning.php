<?php
// Source - https://codereview.stackexchange.com/q/195515
// Posted by Adam, modified by community. See post 'Timeline' for change history
// Retrieved 2026-08-23, License - CC BY-SA 4.0
function pushToTopOfArray($array, $value): array
{
    switch ($value) {
        case '1':
            $array = [1, 2, 3];
            break;

        case '2':
            $array = [2, 1, 3];
            break;

        case '3':
            $array = [3, 1, 2];
            break;
    }
    return $array;
}

foreach (range(1, 3) as $i) {
    echo "shiftValue($i): " . var_export(pushToTopOfArray([1, 2, 3], $i), true) . PHP_EOL;
}