<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;

class Day3 extends Model
{
    protected $fillable = ['inputs'];

    protected $inputs = [];
    protected $image;

    protected $gridWidth;
    protected $gridHeight;

    protected $startX;
    protected $startY;

    protected $steps = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $inputLines = explode("\n", $attributes['inputs']);
        if (!empty($inputLines)) {
            foreach ($inputLines as $inputLine) {
                $this->inputs[] = explode(',', $inputLine);
            }
        }
    }

    protected function drawGrid()
    {
        $this->image = @imagecreate($this->gridWidth, $this->gridHeight) or die("Cannot Initialize new GD image stream");

        imagecolorallocate($this->image, 255, 255, 255);
    }

    protected function getGridSize()
    {
        $this->gridWidth = 4000;
        $this->gridHeight = 4000;

        $this->startX = $this->gridWidth / 2;
        $this->startY = $this->gridHeight / 2;
    }

    protected function drawInstructions()
    {
        if (!empty($this->inputs[0])) {
            $this->drawLine(0, $this->inputs[0], imagecolorallocate($this->image, 0, 255, 0));
        }
        if (!empty($this->inputs[1])) {
            $this->drawLine(1, $this->inputs[1], imagecolorallocate($this->image, 0, 0, 255));
        }

        $red = imagecolorallocate($this->image, 255, 0, 0);

        imagesetpixel($this->image, $this->startX, $this->startY, $red);
    }

    protected function drawLine($line, $inputLines, $colour)
    {
        $currentX = $this->startX;
        $currentY = $this->startY;

        $this->steps[$line][$currentX . 'x' . $currentY] = 0;
        $previousSteps = 0;

        foreach ($inputLines as $input) {
            $direction = substr($input, 0, 1);
            $amount = (int)preg_replace('/[^0-9]/', '', substr($input, 1));

            try {
                switch ($direction) {
                    case 'U';
                        $newAmount = $currentY - $amount;

                        for ($i = 1; $i < $amount; $i++) {
                            $previousSteps++;

                            $this->steps[$line][$currentX . 'x' . ($currentY - $i)] = $previousSteps;
                        }

                        imageline($this->image, $currentX, $currentY, $currentX, $newAmount, $colour);
                        $currentY -= $amount;
                        break;
                    case 'D';
                        $newAmount = $currentY + $amount;

                        for ($i = 1; $i < $amount; $i++) {
                            $previousSteps++;

                            $this->steps[$line][$currentX . 'x' . ($currentY + $i)] = $previousSteps;
                        }
                        imageline($this->image, $currentX, $currentY, $currentX, $newAmount, $colour);
                        $currentY += $amount;
                        break;
                    case 'L';
                        $newAmount = $currentX - $amount;

                        for ($i = 1; $i < $amount; $i++) {
                            $previousSteps++;

                            $this->steps[$line][($currentX - $i) . 'x' . $currentY] = $previousSteps;
                        }

                        imageline($this->image, $currentX, $currentY, $newAmount, $currentY, $colour);
                        $currentX -= $amount;
                        break;
                    case 'R';
                        $newAmount = $currentX + $amount;

                        for ($i = 1; $i < $amount; $i++) {
                            $previousSteps++;

                            $this->steps[$line][($currentX + $i) . 'x' . $currentY] = $previousSteps;
                        }

                        imageline($this->image, $currentX, $currentY, $newAmount, $currentY, $colour);
                        $currentX += $amount;
                        break;
                }

                $previousSteps++;
            } catch (Exception $e) {
                ddl($amount, $previousSteps, $e->getMessage(), $e->getLine());
            }
        }
    }

    protected function calculateGoodStuff()
    {
        $bestSteps = 999999;
        $bestCoordinates = 999999;
        $intersections = [];
        foreach ($this->steps[0] as $coordinates => $steps) {
            if (array_key_exists($coordinates, $this->steps[1])) {
                $currentSteps = $this->steps[0][$coordinates] + $this->steps[1][$coordinates];
                if ($currentSteps > 0 && $currentSteps < $bestSteps) {
                    $bestSteps = $currentSteps;
                }

                $coordinatesSplit = explode('x', $coordinates);
                $coordinates1 = (int)str_replace('-', '', (int)$coordinatesSplit[0] - $this->startX);
                $coordinates2 = (int)str_replace('-', '', (int)$coordinatesSplit[1] - $this->startY);

                $intersections[$coordinates] = [$coordinates1, $coordinates2];

                $currentCoordinates = $coordinates1 + $coordinates2;

                if ($currentCoordinates > 0 && $currentCoordinates < $bestCoordinates) {
                    $bestCoordinates = $currentCoordinates;
                }
            }
        }

        return [$bestCoordinates, $bestSteps];
    }

    public function calculatePart1()
    {
        $this->getGridSize();
        $this->drawGrid();
        $this->drawInstructions();

        imagepng($this->image, storage_path('app/public') . '/day3part1.png');

        return $this->calculateGoodStuff();
    }

    public function calculatePart2()
    {

    }
}
