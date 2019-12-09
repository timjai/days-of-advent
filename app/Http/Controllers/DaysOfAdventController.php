<?php

namespace App\Http\Controllers;

use App\Day1;
use App\Day2;
use App\Day3;
use App\Day4;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DaysOfAdventController extends Controller {

    public function index(Request $request, $day = 1) {
        $method = 'day' . (is_numeric($day) ? $day : 1);
        if (!method_exists($this, $method)) {
            abort(403, 'Day not complete.');
        }

        return $this->{$method}($request);
    }

    public function day1($request) {
        $defaultInput = explode("\n", Storage::get('public/day1.txt'));
        if (!empty($defaultInput)) {
            foreach ($defaultInput as $key => $input) {
                if (empty($input)) {
                    unset($defaultInput[$key]);
                }
            }
        }

        $defaultInputJson = json_encode($defaultInput);

        $data = [
            'part1' => $defaultInputJson,
            'customInput' => ''
        ];

        if ($request->isMethod('post')) {
            if ($request->has('customInput') && !empty($request->get('customInput'))) {
                $defaultInput = json_decode($request->get('customInput'), true);
                $data['customInput'] = json_encode($defaultInput);
            }

            $day1 = new Day1();
            try {
                $data['result1'] = $day1->calculatePart1($defaultInput);
            } catch (Exception $e) {
                $data['result1'] = $e->getMessage() . "\n\n" . $e->getFile() . ':' . $e->getLine();
            }
            try {
                $data['result2'] = $day1->calculatePart2($defaultInput);
            } catch (Exception $e) {
                $data['result2'] = $e->getMessage() . "\n\n" . $e->getFile() . ':' . $e->getLine();
            }
        }

        return view('days.1', $data);
    }

    public function day2($request) {
        $defaultInput = explode(",", str_replace("\n", '', Storage::get('public/day2.txt')));
        if (!empty($defaultInput)) {
            foreach ($defaultInput as $key => $input) {
                $defaultInput[$key] = (int)$input;
            }
        }

        $defaultInputJson = json_encode($defaultInput);

        $data = [
            'part1' => $defaultInputJson,
            'customInput' => ''
        ];

        if ($request->isMethod('post')) {
            if ($request->has('customInput') && !empty($request->get('customInput'))) {
                $defaultInput = json_decode($request->get('customInput'), true);
                $data['customInput'] = json_encode($defaultInput);
            }

            $day2 = new Day2();
            try {
                $data['result1'] = $day2->calculatePart1($defaultInput);
            } catch (Exception $e) {
                $data['result1'] = $e->getMessage() . "\n\n" . $e->getFile() . ':' . $e->getLine();
            }
            try {
                $data['result2'] = $day2->calculatePart2($defaultInput);
            } catch (Exception $e) {
                $data['result2'] = $e->getMessage() . "\n\n" . $e->getFile() . ':' . $e->getLine();
            }

        }
        return view('days.2', $data);

    }

    public function day3($request)
    {
        $defaultInput = Storage::get('public/day3.txt');
        $data = [
            'part1' => $defaultInput,
            'customInput' => ''
        ];

        if ($request->isMethod('post')) {
            if ($request->has('customInput') && !empty($request->get('customInput'))) {
                $defaultInput = $request->get('customInput');
                $data['customInput'] = $request->get('customInput');
            }

            $day = new Day3(['inputs' => $defaultInput]);
            try {
                $data['result1'] = $day->calculatePart1();
            } catch (Exception $e) {
                $data['result1'] = $e->getMessage() . "\n\n" . $e->getFile() . ':' . $e->getLine();
            }
            try {
                $data['result2'] = $day->calculatePart2();
            } catch (Exception $e) {
                $data['result2'] = $e->getMessage() . "\n\n" . $e->getFile() . ':' . $e->getLine();
            }

        }

        return view('days.3', $data);
    }

    public function day4($request) {
        $defaultInput = Storage::get('public/day4.txt');
        $data = [
            'part1' => $defaultInput,
            'customInput' => ''
        ];

        if ($request->isMethod('post')) {
            if ($request->has('customInput') && !empty($request->get('customInput'))) {
                $defaultInput = $request->get('customInput');
                $data['customInput'] = $request->get('customInput');
            }

            $day = new Day4(['inputs' => $defaultInput]);
            try {
                $data['result1'] = $day->calculatePart1();
            } catch (Exception $e) {
                $data['result1'] = $e->getMessage() . "\n\n" . $e->getFile() . ':' . $e->getLine();
            }
            try {
                $data['result2'] = $day->calculatePart2();
            } catch (Exception $e) {
                $data['result2'] = $e->getMessage() . "\n\n" . $e->getFile() . ':' . $e->getLine();
            }

        }
        return view('days.4', $data);

    }

    public function day5($request) {
        $defaultInput = Storage::get('public/day5.txt');
        $data = [
            'part1' => $defaultInput,
            'customInput' => ''
        ];

        if ($request->isMethod('post')) {
            if ($request->has('customInput') && !empty($request->get('customInput'))) {
                $defaultInput = $request->get('customInput');
                $data['customInput'] = $request->get('customInput');
            }

            $day = new Day5(['inputs' => $defaultInput]);
            try {
                $data['result1'] = $day->calculatePart1();
            } catch (Exception $e) {
                $data['result1'] = $e->getMessage() . "\n\n" . $e->getFile() . ':' . $e->getLine();
            }
            try {
                $data['result2'] = $day->calculatePart2();
            } catch (Exception $e) {
                $data['result2'] = $e->getMessage() . "\n\n" . $e->getFile() . ':' . $e->getLine();
            }

        }
        return view('days.5', $data);

    }
}
