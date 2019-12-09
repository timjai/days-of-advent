<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day4 extends Model
{

    protected $fillable = ['inputs'];

    protected $inputs;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->inputs = explode('-', $attributes['inputs']);

        if ($this->inputs[1] <= $this->inputs[0]) {
            dd('Invalid range.');
        }

    }

    protected function xOrMoreDigit($int, $atLeast = 1)
    {
        return preg_match('/(\d)\1{' . $atLeast . ',}/', $int);
    }

    protected function xInARowButNoty($int, $inARow = 2, $butNot = 3)
    {
        return preg_match('/(\d)\1{' . $inARow . '}/', $int) && !preg_match('/(\d)\1{' . $butNot . ',}/', $int);
    }

    protected function nextNumberFewer($int)
    {
        $numberArray = str_split($int, 1);
        $previous = 0;
        foreach ($numberArray as $number) {
            if ((int)$number < $previous) {
                return false;
            }
            $previous = $number;
        }

        return true;
    }

    protected function shitUneligantSolution($int)
    {
        $twoInARow = false;
        $threeOrMore = false;
        preg_match_all('/(\d)\1*/', $int, $result);
        if (!empty($result[0])) {
            foreach ($result[0] as $x) {
                $x = strlen((int)$x);

                if ($x === 2) {
                    $twoInARow = true;
                } else if ($x > 2) {
                    $threeOrMore = true;
                }
            }
        }

        return $twoInARow;
    }

    protected function checkForOddNumberThings($int)
    {
        preg_match_all('/(\d)\1*/', $int, $result);
        if (!empty($result[0])) {
            foreach ($result[0] as $x) {
                $x = strlen((int)$x);

                if ($x > 2 && $x % 2 !== 0) {
                    return false;
                }
            }
        }

      return true;
    }

    public function calculatePart1()
    {
        $validPassword = [];
        $count = 0;

        for ($i = $this->inputs[0]; $i < $this->inputs[1]; $i++) {
            if (!$this->xOrMoreDigit($i)) {
                continue;
            }

            if (!$this->nextNumberFewer($i)) {
                continue;
            }

            $validPassword[] = $i;

            $count++;
        }

        return count($validPassword);

    }

    public function calculatePart2()
    {
        $validPassword = [];
        $count = 0;

        for ($i = $this->inputs[0]; $i < $this->inputs[1]; $i++) {
            if (!$this->xOrMoreDigit($i)) {
                continue;
            }

            if (!$this->shitUneligantSolution($i)) {
                continue;
            }

            if (!$this->nextNumberFewer($i)) {
                continue;
            }

            $validPassword[] = $i;

            $count++;
        }

        return count($validPassword);
    }
}
