<?php

namespace App\Service;

class AlgorithmService
{
    public function getMaxValueInNumberString($input): int
    {
        $a = [];
        $a[0] = 0;
        $a[1] = 1;

        for ($i = 2; $i <= $input; $i++) {
            if ($i % 2 && $i != 1) {
                $roundNumberToFloor = intdiv($i, 2);
                $a[$i] = $a[$roundNumberToFloor] + $a[$roundNumberToFloor + 1];
            } else {
                $a[$i] = $a[$i / 2];
            }
        }

        return max($a);
    }
}