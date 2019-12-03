<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day1 extends Model
{

    public $individualTotal = 0;

    public function fuelFigureBasic($input)
    {
        return floor($input / 3) - 2;
    }

    public function fuelFigure($input)
    {
        $meh = floor($input / 3) - 2;

        if ($meh > 0) {
            $this->individualTotal += $meh;

            return $this->fuelFigure($meh);
        }
    }

    public function calculatePart1($inputs)
    {
        $total = 0;

        foreach ($inputs as $input) {
            $total += $this->fuelFigureBasic($input);
        }

        return $total;
    }

    public function calculatePart2($inputs)
    {
        $total = 0;
        foreach ($inputs as $input) {
            $this->fuelFigure($input);

            $total += $this->individualTotal;

            $this->individualTotal = 0;
        }

        return $total;
    }
}
