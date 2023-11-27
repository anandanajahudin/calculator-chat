<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OperationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('operations')->insert([
            'name' => 'Multiple (perkalian)',
            'operator' => '*',
            'description' => '2 * 2 = 4',
            'created_at' => Carbon::now(),
        ]);
        DB::table('operations')->insert([
            'name' => 'Divide (pembagian)',
            'operator' => '/',
            'description' => '2 / 2 = 1',
            'created_at' => Carbon::now(),
        ]);
        DB::table('operations')->insert([
            'name' => 'Summation (penjumlahan)',
            'operator' => '+',
            'description' => '2 + 2 = 4',
            'created_at' => Carbon::now(),
        ]);
        DB::table('operations')->insert([
            'name' => 'Subtraction (pengurangan)',
            'operator' => '-',
            'description' => '2 - 2 = 0',
            'created_at' => Carbon::now(),
        ]);
        DB::table('operations')->insert([
            'name' => 'log',
            'operator' => 'log',
            'description' => 'log() = 2',
            'created_at' => Carbon::now(),
        ]);
        DB::table('operations')->insert([
            'name' => 'Factorial',
            'operator' => '!',
            'description' => '2! = 2',
            'created_at' => Carbon::now(),
        ]);
        DB::table('operations')->insert([
            'name' => 'Sin',
            'operator' => 'sin',
            'description' => '2! = 2',
            'created_at' => Carbon::now(),
        ]);
        DB::table('operations')->insert([
            'name' => 'Cos',
            'operator' => 'cos',
            'description' => 'cos(2) = 2',
            'created_at' => Carbon::now(),
        ]);
        DB::table('operations')->insert([
            'name' => 'Tan',
            'operator' => 'tan',
            'description' => 'tan(2) = 2',
            'created_at' => Carbon::now(),
        ]);
        DB::table('operations')->insert([
            'name' => 'Cot',
            'operator' => 'cot',
            'description' => 'cot(2) = 2',
            'created_at' => Carbon::now(),
        ]);
        DB::table('operations')->insert([
            'name' => 'Sec',
            'operator' => 'sec',
            'description' => 'sec(2) = 2',
            'created_at' => Carbon::now(),
        ]);
        DB::table('operations')->insert([
            'name' => 'Cosec',
            'operator' => 'cosec',
            'description' => 'cosec(2) = 2',
            'created_at' => Carbon::now(),
        ]);
        DB::table('operations')->insert([
            'name' => 'ArcSin',
            'operator' => 'arcsin',
            'description' => 'arcsin(2) = 2',
            'created_at' => Carbon::now(),
        ]);
        DB::table('operations')->insert([
            'name' => 'ArcCos',
            'operator' => 'arccos',
            'description' => 'arccos(2) = 2',
            'created_at' => Carbon::now(),
        ]);
        DB::table('operations')->insert([
            'name' => 'ArcTan',
            'operator' => 'arctan',
            'description' => 'arctan(2) = 2',
            'created_at' => Carbon::now(),
        ]);
        DB::table('operations')->insert([
            'name' => 'Sigma',
            'operator' => 'sigma',
            'description' => 'sigma',
            'created_at' => Carbon::now(),
        ]);
        DB::table('operations')->insert([
            'name' => 'Degree',
            'operator' => 'degree',
            'description' => 'degree(2)',
            'created_at' => Carbon::now(),
        ]);
        DB::table('operations')->insert([
            'name' => 'Radian',
            'operator' => 'radian',
            'description' => 'radian(45)',
            'created_at' => Carbon::now(),
        ]);
        DB::table('operations')->insert([
            'name' => 'Probability',
            'operator' => 'probability',
            'description' => 'probability(3, 6)',
            'created_at' => Carbon::now(),
        ]);
        DB::table('operations')->insert([
            'name' => 'Pythagorean Theorem',
            'operator' => 'pythagorean',
            'description' => 'pythagorean(5, 12)',
            'created_at' => Carbon::now(),
        ]);
    }
}
