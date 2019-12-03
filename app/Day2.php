<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day2 extends Model
{

    public function doStuff($inputs, $x = null, $y = null)
    {
        if (!is_null($x)) {
            $inputs[1] = $x;
        }
        if (!is_null($y)) {
            $inputs[2] = $y;
        }

        $inputsChunked = array_chunk($inputs, 4);

        foreach ($inputsChunked as $key => $chunk) {
            $inputsChunkedRevised = array_chunk($inputs, 4);
            $chunk = $inputsChunkedRevised[$key];

            if ($chunk[0] === 99) {
                break;
            }

            $input1 = $inputs[$chunk[1]] !== null ? $inputs[$chunk[1]] : null;
            $input2 = $inputs[$chunk[2]] !== null ? $inputs[$chunk[2]] : null;

            switch ($chunk[0]) {
                case 1:
                    $output = $input1 + $input2;
                    break;
                case 2:
                    $output = $input1 * $input2;
                    break;
            }

            $inputs[$chunk[3]] = $output;
        }

        return $inputs;
    }

    public function calculatePart1($inputs)
    {
        return $this->doStuff($inputs)[0];
    }

    public function calculatePart2($inputs)
    {
        $x = 0;
        $y = 0;
        while ($x < 99) {
            while ($y < 99) {
                $result = $this->doStuff($inputs, $x, $y);
                if ($result[0] === 19690720) {
                    return 100 * $x + $y;
                }

                $y++;
                if ($y === 98) {
                    $x++;
                    $y = 0;
                }
            }
        }

        return 'Failed';
    }
}
