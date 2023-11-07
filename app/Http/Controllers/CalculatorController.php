<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Calculator;
use App\Models\Helper;
use App\Models\Operation;
use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function index()
    {
        $operations = Operation::all();
        $calculators = Calculator::orderBy('id', 'DESC')->get();

        return view('pages.calculator.index',
        [
            'calculators' => $calculators,
            'operations' => $operations,
        ]);
    }

    public function create()
    {
        $operations = Operation::all();

        return view('pages.calculator.create', [
            'operations' => $operations
        ]);
    }

    public function store(Request $request) {

        $this->validate($request, [
            'chat' => 'required',
        ]);

        $chat = $request->chat;

        if ($chat == 'About' || $chat == 'ABOUT' || $chat == 'about') {

            $calculator = Calculator::create([
                'chat' => $chat,
            ]);

            $id = $calculator->id;

            return redirect()->route('calculator.about', [$id])->with(['success' => 'The result of about!']);

        } else if ($chat == 'Help' || $chat == 'HELP' || $chat == 'help') {

            $calculator = Calculator::create([
                'chat' => $chat,
            ]);

            $id = $calculator->id;

            return redirect()->route('calculator.help', [$id])->with(['success' => 'The result of help!']);

        } else if ($chat == 'Profile' || $chat == 'PROFILE' || $chat == 'profile') {

            $calculator = Calculator::create([
                'chat' => $chat,
            ]);

            $id = $calculator->id;

            return redirect()->route('calculator.profile', [$id])->with(['success' => 'The result of profile!']);

        } else if ($chat == 'History' || $chat == 'HISTORY' || $chat == 'history') {

            $calculator = Calculator::create([
                'chat' => $chat,
            ]);

            $id = $calculator->id;

            return redirect()->route('calculator.history')->with(['success' => 'The result history of your calculations!']);

        } else {
            $arrSplit = str_split($chat, 1);
            $jumKarakter = strlen($chat);
            $pattern = '/^[A-Za-z]+$/';

            $arrBaru = [];
            $operator = '';
            $arrAngka = [];
            $angka1 = 0;
            $angka2 = 0;

            for($i=0; $i < $jumKarakter; $i++) {

                if ( preg_match($pattern, $arrSplit[$i]) ) {
                } else {
                    array_push($arrBaru, $arrSplit[$i]);
                }

                if (preg_match('/[\*+-]/', $arrSplit[$i])) {
                    $operator = $arrSplit[$i];
                }

                if (is_numeric($arrSplit[$i])) {
                    array_push($arrAngka, $arrSplit[$i]);
                }
            }

            $angka1 = intval($arrAngka[0]);
            $angka2 = intval($arrAngka[1]);
            $hasil = $angka1 .' '. $operator .' '. $angka2;

            if ($operator == '+') {
                $hasil = $angka1 + $angka2;
            } else if ($operator == '-') {
                $hasil = $angka1 - $angka2;
            } else if ($operator == '*') {
                $hasil = $angka1 * $angka2;
            } else if ($operator == '/') {
                if ($angka2 != 0) {
                    $hasil = $angka1 / $angka2;
                } else {
                    $hasil = 'Division by zero is undefined';
                }
            }

            $calculator = Calculator::create([
                'chat' => $chat,
                'first_number' => $angka1,
                'last_number' => $angka2,
                'operator' => $operator,
                'result' => $hasil,
            ]);

            $id = $calculator->id;

            return redirect()->route('calculator.show', [$id])->with(['success' => 'The result of math solve!']);
        }
    }

    // The result of calculator solve
    public function show(string $id)
    {
        $calculator = Calculator::findOrFail($id);

        return view('pages.calculator.result.show', compact('calculator'));
    }

    // The result of about command
    public function about(string $id)
    {
        $calculator = Calculator::findOrFail($id);
        $result = Helper::select('about')->where('id', 1)->first()->about;

        return view('pages.calculator.result.basic', compact('calculator', 'result'));
    }

    // The result of profile command
    public function profile(string $id)
    {
        $calculator = Calculator::findOrFail($id);
        $result = Helper::select('profile')->where('id', 1)->first()->profile;

        return view('pages.calculator.result.basic', compact('calculator', 'result'));
    }

    // The result of help command
    public function help(string $id)
    {
        $calculator = Calculator::findOrFail($id);

        return view('pages.calculator.result.help', compact('calculator'));
    }

    // The result of history command
    public function history()
    {
        $calculators = Calculator::select("*")
            ->whereNotNull('first_number')
            ->whereNotNull('operator')
            ->whereNotNull('last_number')
            ->whereNotNull('result')
            ->get();

        return view('pages.calculator.result.history', compact('calculators'));
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}