<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;

class Day4 extends Model
{
    protected $fillable = ['inputs'];

    protected $inputs;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->inputs = $attributes['inputs'];
    }

    public function calculatePart1()
    {

    }

    public function calculatePart2()
    {

    }
}
