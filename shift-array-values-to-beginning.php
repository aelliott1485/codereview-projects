<?php
// Source - https://codereview.stackexchange.com/q/195515
// Posted by Adam, modified by community. See post 'Timeline' for change history
// Retrieved 2026-08-23, License - CC BY-SA 4.0
function pushToTopOfArray($array, $value): array
{
    array_unshift($array, array_splice($array, $value - 1, 1)[0]);
    return $array;
}

foreach (range(1, 3) as $i) {
    echo "shiftValue($i): " . var_export(pushToTopOfArray([1, 2, 3], $i), true) . PHP_EOL;
}