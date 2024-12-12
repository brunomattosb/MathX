<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home(): View{
        return view('home');
    }
    public function generateExcercises(Request $request) : View{
        $request->validate([
            'check_sum' => 'required_without_all:check_subtraction,check_multiplication,check_division',
            'check_subtraction' => 'required_without_all:check_sum,check_multiplication,check_division',
            'check_multiplication' => 'required_without_all:check_subtraction,check_sum,check_division',
            'check_division' => 'required_without_all:check_subtraction,check_multiplication,check_sum',

            'number_one' =>'required|integer|min:0|max:999|lt:number_two',
            'number_two' =>'required|integer|min:0|max:999',
            'number_exercises' => 'required|integer|min:5|max:50'
        ]);

        $operations = [];
        if ($request->check_sum) {
            $operations[] = 'sum';
        }
        if ($request->check_subtraction) {
            $operations[] = 'subtraction';
        }
        if ($request->check_multiplication) {
            $operations[] = 'multiplication';
        }
        if ($request->check_division) {
            $operations[] = 'division';
        }

        $min = $request->number_one;
        $max = $request->number_two;

        $numberExercises = $request->number_exercises;

        $exercises = [];
        for($index = 1; $index <= $numberExercises; $index++){
            $operation = $operations[array_rand($operations)];
            $number1 = rand($min, $max);
            $number2 = rand($min, $max);

            $exercise = '';
            $sollution = '';

            switch ($operation){
                case 'sum':
                    $exercise = "$number1 + $number2 =";
                    $sollution = $number1 + $number2;
                    break;
                case 'subtraction':
                    $exercise = "$number1 - $number2 =";
                    $sollution = $number1 - $number2;
                    break;
                case 'multiplication':
                    $exercise = "$number1 x $number2 =";
                    $sollution = $number1 * $number2;
                    break;
                case 'division':
                    $number2 = $number2 == 0 ? 1 : $number2;
                    $exercise = "$number1 / $number2 =";
                    $sollution = $number1 / $number2;
                    break;
            }

            if(is_float($sollution)){
                $sollution = round($sollution, 2);
            }

            $exercises[] = [
                'operation' => $operation,
                'exercise_number' => $index,
                'exercise'  => $exercise,
                'sollution' => "$exercise $sollution"
            ];
        }

        return view('operations', ['exercises' => $exercises]);
    }
    public function printExcercises(){
        echo 'imprimir no navegador';
    }
    public function exportExcercises(){
        echo 'Exportar';
    }
}
