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

        return view('pages.back.calculator.index',
        [
            'calculators' => $calculators,
            'operations' => $operations,
        ]);
    }

    public function sigma() {
        return view('pages.back.calculator.sigma');
    }

    public function graph() {
        return view('pages.back.calculator.graph');
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

        $chat = strtolower($request->chat);

        // ABOUT
        if (str_contains($chat, 'about')) {

            $calculator = Calculator::create([
                'chat' => $chat,
            ]);

            $id = $calculator->id;

            return redirect()->route('calculator.about', [$id])->with(['success' => 'The result of about!']);

        } else if (str_contains($chat, 'help')) {

            $calculator = Calculator::create([
                'chat' => $chat,
            ]);

            $id = $calculator->id;

            return redirect()->route('calculator.help', [$id])->with(['success' => 'The result of help!']);

        } else if (str_contains($chat, 'profile')) {

            $calculator = Calculator::create([
                'chat' => $chat,
            ]);

            $id = $calculator->id;

            return redirect()->route('calculator.profile', [$id])->with(['success' => 'The result of profile!']);

        } else if (str_contains($chat, 'history')) {

            $calculator = Calculator::create([
                'chat' => $chat,
            ]);

            $id = $calculator->id;

            return redirect()->route('calculator.history', [$id])->with(['success' => 'The result history of your calculations!']);

        } else if (str_contains($chat, 'sigma')) {

            return redirect()->route('calculator.sigma');

        } else if (str_contains($chat, 'graph')) {

            return redirect()->route('calculator.graph');

        } else {
            preg_match_all('!\d+!', $chat, $matches);
            $jumlahBilangan = count($matches[0]);

            if ($jumlahBilangan < 1) {
                // Log Grafik
                if (str_contains($chat, 'log')) {

                    if (str_contains($chat, 'graph')) {
                        if (str_contains($chat, 'graph') && str_contains($chat, 'log') && str_contains($chat, 'x')) {
                            $calculator = Calculator::create([
                                'chat' => $chat
                            ]);
                            $id = $calculator->id;

                            return redirect()->route('calculator.show', [$id])->with(['success' => 'Graphical result of a log x']);

                        } else if (str_contains($chat, 'graph') && str_contains($chat, 'log') && str_contains($chat, 'y')) {
                            $calculator = Calculator::create([
                                'chat' => $chat
                            ]);
                            $id = $calculator->id;

                            return redirect()->route('calculator.show', [$id])->with(['success' => 'Graphical result of a log y']);

                        } else {
                            return redirect()->route('dashboard')->with(['error' => 'Cannot generate graph because your input is invalid!']);
                        }

                    } else {
                        return redirect()->route('dashboard')->with(['error' => 'Your input is not valid!']);
                    }

                // Sin Grafik
                } else if (str_contains($chat, 'sin')) {

                    if (str_contains($chat, 'graph')) {
                        if (str_contains($chat, 'graph') && str_contains($chat, 'sin') && str_contains($chat, 'x')) {
                            $calculator = Calculator::create([
                                'chat' => $chat
                            ]);
                            $id = $calculator->id;

                            return redirect()->route('calculator.show', [$id])->with(['success' => 'Graphical result of a sin x']);

                        } else {
                            return redirect()->route('dashboard')->with(['error' => 'Cannot generate graph because your input is invalid!']);
                        }

                    } else {
                        return redirect()->route('dashboard')->with(['error' => 'Your input is not valid!']);
                    }

                } else if (str_contains($chat, 'cos')) {

                    // Cos Grafik
                    if (str_contains($chat, 'graph')) {
                        if (str_contains($chat, 'graph') && str_contains($chat, 'cos') && str_contains($chat, 'x')) {
                            $calculator = Calculator::create([
                                'chat' => $chat
                            ]);
                            $id = $calculator->id;

                            return redirect()->route('calculator.show', [$id])->with(['success' => 'Graphical result of a cos x']);

                        } else {
                            return redirect()->route('dashboard')->with(['error' => 'Cannot generate graph because your input is invalid!']);
                        }

                    } else {
                        return redirect()->route('dashboard')->with(['error' => 'Your input is not valid!']);
                    }

                } else {
                    return redirect()->route('dashboard')->with(['error' => 'Your input is not valid!']);
                }

            } else {
                // KALKULASI
                $angka1 = intval($matches[0][0]);

                // Persamaan Linier 2 variabel x dan y, Example (2x + 3y = 6)
                if (str_contains($chat, 'x') && str_contains($chat, 'y')) {

                    if ($jumlahBilangan == 2) {

                        $angka2 = intval($matches[0][1]);

                        if (str_contains($chat, '+')) {
                            $perpotonganSumbuY = ($angka1 * -1);

                            if ($angka2 % $angka1 == 0 && $angka1 % $angka1 == 0) {
                                $angka1 = $angka1 / $angka1;
                                $angka2 = $angka2 / $angka1;
                            }

                            $result = pow($angka1, $angka2);

                            $calculator = Calculator::create([
                                'chat' => $chat,
                                'first_number' => $angka2,
                                'last_number' => $perpotonganSumbuY,
                                'result' => $result,
                            ]);
                            $id = $calculator->id;

                            return redirect()->route('calculator.show', [$id])->with(['success' => 'The result of a linear equation between two variables x and y']);

                        } else if (str_contains($chat, '-')) {

                            if ($angka2 % $angka1 == 0 && $angka1 % $angka1 == 0) {
                                $angka1 = $angka1 / $angka1;
                                $angka2 = $angka2 / $angka1;
                            }

                            $result = pow($angka1, $angka2);

                            $calculator = Calculator::create([
                                'chat' => $chat,
                                'first_number' => $angka2,
                                'last_number' => $angka1,
                                'result' => $result,
                            ]);
                            $id = $calculator->id;

                            return redirect()->route('calculator.show', [$id])->with(['success' => 'The result of a linear equation between two variables x and y']);

                        } else {
                            return redirect()->route('dsahboard')->with(['error' => 'Your input is not valid!']);
                        }

                    } else if ($jumlahBilangan == 3) {

                        // Persamaan linier 2 variabel x dan y serta = bilangan
                        if (str_contains($chat, 'x') && str_contains($chat, 'y') && str_contains($chat, '=')) {

                            $angka2 = intval($matches[0][1]);
                            $angka3 = intval($matches[0][2]);
                            $nilaiX = floatval($angka3 / $angka1);

                            if (str_contains($chat, '-')) {
                                $nilaiY = floatval($angka3 / $angka2) * (-1);
                            } else {
                                $nilaiY = floatval($angka3 / $angka2);
                            }

                            $calculator = Calculator::create([
                                'chat' => $chat,
                                'first_number' => $nilaiX,
                                'last_number' => $nilaiY,
                            ]);
                            $id = $calculator->id;

                            return redirect()->route('calculator.show', [$id])->with(['success' => 'The result of a linear equation has been solved']);

                        } else {
                            return redirect()->route('dashboard')->with(['error' => 'Equation is Invalid! (For Example: 2x + 3y = 7)']);
                        }
                    } else {
                        return redirect()->route('dashboard')->with(['error' => 'Equation is Invalid! (For Example: 2x + 6y)']);
                    }

                } else if (str_contains($chat, 'x') && str_contains($chat, '=')) {

                    // Persamaan Linier 1 variabel x, Example (x = 6)
                    if ($jumlahBilangan == 1) {

                        $calculator = Calculator::create([
                            'chat' => $chat,
                            'first_number' => $angka1,
                            'result' => $angka1,
                        ]);
                        $id = $calculator->id;

                        return redirect()->route('calculator.show', [$id])->with(['success' => 'The result of a linear equation one variable x']);

                    // Persamaan Linier 1 variabel x, Example (2x = 6)
                    } else if ($jumlahBilangan == 2) {

                        $angka2 = intval($matches[0][1]);
                        $result = $angka2 / $angka1;

                        $calculator = Calculator::create([
                            'chat' => $chat,
                            'first_number' => $angka1,
                            'result' => $result,
                        ]);
                        $id = $calculator->id;

                        return redirect()->route('calculator.show', [$id])->with(['success' => 'The result of a linear equation one variable x']);

                    // Persamaan Linier 1 variabel x, Example (2x + 4 = 6) or (2x - 4 = 6)
                    } else if ($jumlahBilangan == 3) {

                        $angka2 = intval($matches[0][1]);
                        $angka3 = intval($matches[0][2]);

                        if (str_contains($chat, '+')) {

                            $result = ($angka3 - $angka2) / $angka1;

                            $calculator = Calculator::create([
                                'chat' => $chat,
                                'first_number' => $angka1,
                                'result' => $result,
                            ]);
                            $id = $calculator->id;

                            return redirect()->route('calculator.show', [$id])->with(['success' => 'The result of a linear equation one variable x']);

                        } else if (str_contains($chat, '-')) {

                            $result = ($angka3 + $angka2) / $angka1;

                            $calculator = Calculator::create([
                                'chat' => $chat,
                                'first_number' => $angka1,
                                'result' => $result,
                            ]);
                            $id = $calculator->id;

                            return redirect()->route('calculator.show', [$id])->with(['success' => 'The result of a linear equation one variable x']);

                        } else {
                            return redirect()->route('dashboard')->with(['error' => 'Equation is Invalid! (For Example: 2x - 4 = 6)']);
                        }
                    } else {
                        return redirect()->route('dashboard')->with(['error' => 'Equation is Invalid! (For Example: 2x = 6)']);
                    }

                } else if (str_contains($chat, 'y') && str_contains($chat, '=')) {

                    // Persamaan Linier 1 variabel y, Example (y = 6)
                    if ($jumlahBilangan == 1) {
                        $calculator = Calculator::create([
                            'chat' => $chat,
                            'last_number' => $angka1,
                            'result' => $angka1,
                        ]);
                        $id = $calculator->id;

                        return redirect()->route('calculator.show', [$id])->with(['success' => 'The result of a linear equation one variable x']);

                    // Persamaan Linier 1 variabel y, Example (2y = 6)
                    } else if ($jumlahBilangan == 2) {

                        $angka2 = intval($matches[0][1]);
                        $result = $angka2 / $angka1;

                        $calculator = Calculator::create([
                            'chat' => $chat,
                            'last_number' => $angka1,
                            'result' => $result,
                        ]);
                        $id = $calculator->id;

                        return redirect()->route('calculator.show', [$id])->with(['success' => 'The result of a linear equation one variable y']);

                    // Persamaan Linier 1 variabel x, Example (2x + 4 = 6) or (2x - 4 = 6)
                    } else if ($jumlahBilangan == 3) {

                        $angka2 = intval($matches[0][1]);
                        $angka3 = intval($matches[0][2]);

                        if (str_contains($chat, '+')) {

                            $result = ($angka3 - $angka2) / $angka1;

                            $calculator = Calculator::create([
                                'chat' => $chat,
                                'last_number' => $angka1,
                                'result' => $result,
                            ]);
                            $id = $calculator->id;

                            return redirect()->route('calculator.show', [$id])->with(['success' => 'The result of a linear equation one variable y']);

                        } else if (str_contains($chat, '-')) {

                            $result = ($angka3 + $angka2) / $angka1;

                            $calculator = Calculator::create([
                                'chat' => $chat,
                                'last_number' => $angka1,
                                'result' => $result,
                            ]);
                            $id = $calculator->id;

                            return redirect()->route('calculator.show', [$id])->with(['success' => 'The result of a linear equation one variable y']);

                        } else {
                            return redirect()->route('dashboard')->with(['error' => 'Equation is Invalid! (For Example: 2x - 4 = 6)']);
                        }
                    } else {
                        return redirect()->route('dashboard')->with(['error' => 'Equation is Invalid! (For Example: 2x = 6)']);
                    }

                } else {
                    // Log
                    if (str_contains($chat, 'log')) {
                        if ($jumlahBilangan == 1) {
                            $hasil = log($angka1);
                            $operator = "log";

                            $calculator = Calculator::create([
                                'chat' => $chat,
                                'first_number' => $angka1,
                                'operator' => $operator,
                                'result' => $hasil,
                            ]);

                        // Log 10
                        } else if ($jumlahBilangan == 2) {
                            $angka2 = intval($matches[0][1]);

                            if ($angka1 == 10) {
                                $hasil = log10($angka2);
                                $operator = "log10";

                                $calculator = Calculator::create([
                                    'chat' => $chat,
                                    'first_number' => $angka2,
                                    'operator' => $operator,
                                    'result' => $hasil,
                                ]);

                            } else {
                                $hasil = log($angka1, $angka2);
                                $operator = "log";

                                $calculator = Calculator::create([
                                    'chat' => $chat,
                                    'first_number' => $angka1,
                                    'operator' => $operator,
                                    'result' => $hasil,
                                ]);
                            }
                        } else {
                            return redirect()->route('dashboard')->with(['error' => 'Your input for logarithm is not correct!']);
                        }

                    // Factorial
                    } else if (str_contains($chat, '!')) {
                        if ($jumlahBilangan == 1) {
                            $factorial = 1;
                            for ($i = 1; $i <= $angka1; $i++){
                                $factorial = $factorial * $i;
                            }

                            $hasil = $factorial;
                            $operator = "!";

                            $calculator = Calculator::create([
                                'chat' => $chat,
                                'first_number' => $angka1,
                                'operator' => $operator,
                                'result' => $hasil,
                            ]);
                        } else {
                            return redirect()->route('dashboard')->with(['error' => 'Factorial Only for 1 Number!']);
                        }

                    // Sin
                    } else if (str_contains($chat, 'sin')) {
                        if ($jumlahBilangan == 1) {
                            $hasil = sin($angka1);
                            $operator = "sin";

                            $calculator = Calculator::create([
                                'chat' => $chat,
                                'first_number' => $angka1,
                                'operator' => $operator,
                                'result' => $hasil,
                            ]);
                        } else {
                            return redirect()->route('dashboard')->with(['error' => 'Sine Only for 1 Number!']);
                        }

                    // Cos
                    } else if (str_contains($chat, 'cos')) {
                        if ($jumlahBilangan == 1) {
                            $hasil = cos($angka1);
                            $operator = "cos";

                            $calculator = Calculator::create([
                                'chat' => $chat,
                                'first_number' => $angka1,
                                'operator' => $operator,
                                'result' => $hasil,
                            ]);
                        } else {
                            return redirect()->route('dashboard')->with(['error' => 'Cosine Only for 1 Number!']);
                        }

                    // Tan
                    } else if (str_contains($chat, 'tan')) {
                        if ($jumlahBilangan == 1) {
                            $hasil = tan($angka1);
                            $operator = "tan";

                            $calculator = Calculator::create([
                                'chat' => $chat,
                                'first_number' => $angka1,
                                'operator' => $operator,
                                'result' => $hasil,
                            ]);
                        } else {
                            return redirect()->route('dashboard')->with(['error' => 'Tangent Only for 1 Number!']);
                        }

                    // Cotan
                    } else if (str_contains($chat, 'cot')) {
                        if ($jumlahBilangan == 1) {
                            $hasil = cot($angka1);
                            $operator = "cot";

                            $calculator = Calculator::create([
                                'chat' => $chat,
                                'first_number' => $angka1,
                                'operator' => $operator,
                                'result' => $hasil,
                            ]);
                        } else {
                            return redirect()->route('dashboard')->with(['error' => 'Cotangent Only for 1 Number!']);
                        }

                    // Sec
                    } else if (str_contains($chat, 'sec')) {
                        if ($jumlahBilangan == 1) {
                            $hasil = sec($angka1);
                            $operator = "sec";

                            $calculator = Calculator::create([
                                'chat' => $chat,
                                'first_number' => $angka1,
                                'operator' => $operator,
                                'result' => $hasil,
                            ]);
                        } else {
                            return redirect()->route('dashboard')->with(['error' => 'Secant Only for 1 Number!']);
                        }

                    // Cosec
                    } else if (str_contains($chat, 'cosec')) {
                        if ($jumlahBilangan == 1) {
                            $hasil = cosec($angka1);
                            $operator = "cosec";

                            $calculator = Calculator::create([
                                'chat' => $chat,
                                'first_number' => $angka1,
                                'operator' => $operator,
                                'result' => $hasil,
                            ]);
                        } else {
                            return redirect()->route('dashboard')->with(['error' => 'Cosecant Only for 1 Number!']);
                        }

                    // Arcsin
                    } else if (str_contains($chat, 'arcsin')) {
                        if ($jumlahBilangan == 1) {
                            $hasil = arcsin($angka1);
                            $operator = "arcsin";

                            $calculator = Calculator::create([
                                'chat' => $chat,
                                'first_number' => $angka1,
                                'operator' => $operator,
                                'result' => $hasil,
                            ]);
                        } else {
                            return redirect()->route('dashboard')->with(['error' => 'Inverse Since Only for 1 Number!']);
                        }

                    // Arccos
                    } else if (str_contains($chat, 'arccos')) {
                        if ($jumlahBilangan == 1) {
                            $hasil = arccos($angka1);
                            $operator = "arccos";

                            $calculator = Calculator::create([
                                'chat' => $chat,
                                'first_number' => $angka1,
                                'operator' => $operator,
                                'result' => $hasil,
                            ]);
                        } else {
                            return redirect()->route('dashboard')->with(['error' => 'Inverse Cosine Only for 1 Number!']);
                        }

                    // Arctan
                    } else if (str_contains($chat, 'arctan')) {
                        if ($jumlahBilangan == 1) {
                            $hasil = arctan($angka1);
                            $operator = "arctan";

                            $calculator = Calculator::create([
                                'chat' => $chat,
                                'first_number' => $angka1,
                                'operator' => $operator,
                                'result' => $hasil,
                            ]);
                        } else {
                            return redirect()->route('dashboard')->with(['error' => 'Inverse Tangent Only for 1 Number!']);
                        }

                        // Sigma
                    } else if (str_contains($chat, 'sigma')) {

                        return redirect()->route('sigma.index');

                        // $angka2 = $matches[0][0];

                        // if ($jumlahBilangan == 1) {
                        //     $hasil = rad2deg($angka1);
                        //     $operator = "degree";

                        //     $calculator = Calculator::create([
                        //         'chat' => $chat,
                        //         'first_number' => $angka1,
                        //         'operator' => $operator,
                        //         'result' => $hasil,
                        //     ]);
                        // } else {
                        //     return redirect()->route('dashboard')->with(['error' => 'Your input is invalid, only for integer value!']);
                        // }

                    // Degree
                    } else if (str_contains($chat, 'degree')) {
                        $angka1 = $matches[0][0];

                        if ($jumlahBilangan == 1) {
                            $hasil = rad2deg($angka1);
                            $operator = "degree";

                            $calculator = Calculator::create([
                                'chat' => $chat,
                                'first_number' => $angka1,
                                'operator' => $operator,
                                'result' => $hasil,
                            ]);
                        } else {
                            return redirect()->route('dashboard')->with(['error' => 'Your input is invalid, only for integer value!']);
                        }

                    // Radian
                    } else if (str_contains($chat, 'rad') || str_contains($chat, 'radian')) {
                        if ($jumlahBilangan == 1) {
                            $hasil = deg2rad($angka1);
                            $operator = "radian";

                            $calculator = Calculator::create([
                                'chat' => $chat,
                                'first_number' => $angka1,
                                'operator' => $operator,
                                'result' => $hasil,
                            ]);
                        } else {
                            return redirect()->route('dashboard')->with(['error' => 'Your input is invalid!']);
                        }

                    // Probabilitas
                    } else if (str_contains($chat, 'prob') || str_contains($chat, 'probability')) {

                        if ($jumlahBilangan == 2) {

                            $angka2 = intval($matches[0][1]);
                            $probability = $angka1 / $angka2;
                            $operator = "probability";

                            // banyak kemungkinan muncul n(A) = $angka1
                            // banyak ruang sampel n(S) = $angka2
                            // Probabilitas P(A) = n(A) / n(S)

                            $hasil = $probability;

                            $calculator = Calculator::create([
                                'chat' => $chat,
                                'first_number' => $angka1,
                                'last_number' => $angka2,
                                'operator' => $operator,
                                'result' => $hasil,
                            ]);
                        } else {
                            return redirect()->route('dashboard')->with(['error' => 'Your input is invalid!']);
                        }

                    // Pythagorean theorem
                    } else if (str_contains($chat, 'pythagorean')) {

                        if ($jumlahBilangan == 2) {

                            // a = $angka1
                            // b = $angka2
                            $angka2 = intval($matches[0][1]);

                            // Pythagorean c = sqrt(a + b)
                            $hasil = sqrt(pow($angka1, 2) + pow($angka2, 2));

                            $operator = "pythagorean";

                            $calculator = Calculator::create([
                                'chat' => $chat,
                                'first_number' => $angka1,
                                'last_number' => $angka2,
                                'operator' => $operator,
                                'result' => $hasil,
                            ]);
                        } else {
                            return redirect()->route('dashboard')->with(['error' => 'Your input is invalid!']);
                        }

                    // Heron's theorem
                    } else if (str_contains($chat, 'heron')) {

                        if ($jumlahBilangan == 3) {

                            // a = $angka1
                            // b = $angka2
                            $angka2 = intval($matches[0][1]);
                            // c = $angka3
                            $angka3 = intval($matches[0][2]);

                            // s = (a + b + c) / 2
                            $angkaS = ($angka1 + $angka2 + $angka3) / 2;

                            // Heron A = sqrt( s (s - a) (s - b) (s - c) )
                            $hasil = sqrt($angkaS * ($angkaS - $angka1) * ($angkaS - $angka2) * ($angkaS - $angka3));

                            $operator = "heron";

                            $calculatorSave = Calculator::create([
                                'chat' => $chat,
                                'operator' => $operator,
                                'result' => $hasil,
                            ]);
                            $calculator = Calculator::findOrFail($calculatorSave->id);

                            return view('pages.back.calculator.result.show', [$calculatorSave->id])
                                ->with([
                                    'success' => 'The result of math solve HERON!',
                                    'calculator' => $calculator,
                                    'angka1' => $angka1,
                                    'angka2' => $angka2,
                                    'angka3' => $angka3,
                                    'angkaS' => $angkaS
                                ]);
                        }

                    } else if (str_contains($chat, 'circle')) {

                        if ($jumlahBilangan == 1) {

                            // Luas lingkaran A = pi * r * r
                            $hasil = pi() * pow($angka1, 2);

                            $operator = "circle";

                            $calculator = Calculator::create([
                                'chat' => $chat,
                                'first_number' => $angka1,
                                'operator' => $operator,
                                'result' => $hasil,
                            ]);

                        } else {
                            return redirect()->route('dashboard')->with(['error' => 'Your input is invalid!']);
                        }

                    // Kalkulator Operator Dasar + - * /
                    } else {

                        if ($jumlahBilangan == 2) {
                            $arrSplit = str_split($chat, 1);
                            $jumKarakter = strlen($chat);
                            $pattern = '/^[A-Za-z]+$/';

                            $arrBaru = [];
                            $operator = '';
                            $arrAngka = [];

                            for($i=0; $i < $jumKarakter; $i++) {
                                if (preg_match('/[\*+-\/]/', $arrSplit[$i])) {
                                    $operator = $arrSplit[$i];
                                }
                            }

                            $angka2 = intval($matches[0][1]);
                            // $hasil = $angka1 .' '. $operator .' '. $angka2;

                            // Penjumlahan
                            if ($operator == '+') {
                                $hasil = $angka1 + $angka2;

                            // Pengurangan
                            } else if ($operator == '-') {
                                $hasil = $angka1 - $angka2;

                            // Perkalian
                            } else if ($operator == '*') {
                                $hasil = $angka1 * $angka2;

                            // Pembagian
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

                        } else {
                            return redirect()->route('dashboard')->with(['error' => 'Your input is invalid']);
                        }

                    }
                    $id = $calculator->id;

                    return redirect()->route('calculator.show', [$id])->with(['success' => 'The result of math solve!']);
                }
            }
        }
    }

    // The result of calculator solve
    public function show(string $id)
    {
        $calculator = Calculator::findOrFail($id);

        return view('pages.back.calculator.result.show', compact('calculator'));
    }

    // The result of about command
    public function about(string $id)
    {
        $calculator = Calculator::findOrFail($id);
        $result = Helper::select('about')->where('id', 1)->first()->about;

        return view('pages.back.calculator.result.basic', compact('calculator', 'result'));
    }

    // The result of profile command
    public function profile(string $id)
    {
        $calculator = Calculator::findOrFail($id);
        $result = Helper::select('profile')->where('id', 1)->first()->profile;

        return view('pages.back.calculator.result.basic', compact('calculator', 'result'));
    }

    // The result of help command
    public function help(string $id)
    {
        $calculator = Calculator::findOrFail($id);

        return view('pages.back.calculator.result.help', compact('calculator'));
    }

    // The result of history command
    public function history(string $id)
    {
        $calculator = Calculator::findOrFail($id);

        $calculators = Calculator::select("*")
            ->whereNotNull('first_number')
            ->whereNotNull('operator')
            ->whereNotNull('result')
            ->get();

        return view('pages.back.calculator.result.history', compact('calculator','calculators'));
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
