<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;

class PythonController extends Controller
{
    public function generateGraph()
    {
        $scriptPath = base_path('resources/views/pages/back/test.py');

        $output = [];
        $exitCode = 0;

        exec("python {$scriptPath}", $output, $exitCode);

        implode("\n", $output);

        return redirect()->back();
    }
}
