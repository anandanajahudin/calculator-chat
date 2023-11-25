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

    public function generatePlotEquation(Request $request)
    {
        $equation = $request->input('equation');
        $xVal = $request->input('xVal');
        $yVal = $request->input('yVal');

        $scriptPath = base_path('resources/views/pages/back/calculator/result/equation.py');

        $output = [];
        $exitCode = 0;

        exec("python {$scriptPath}", $xVal, $yVal);

        implode("\n", $output);

        return redirect()->back();

        // $outputPath = public_path('generated_plot.png');

        // $process = new Process(["python", $scriptPath, $equation]);
        // $process->run();

        // // Handle response or redirect as needed
        // return response()->json([
        //     'output' => $process->getOutput(),
        //     'plot_path' => asset('generated_plot.png')
        // ]);
    }

    public function generatePlot(Request $request)
    {
        // Get input values from the request
        $xValues = $request->input('xVal');
        $yValues = $request->input('yVal');

        // Path to the Python script
        $scriptPath = base_path('resources/views/pages/back/calculator/plot.py');

        // Execute the Python script with input values
        $process = new Process(["python", $scriptPath, json_encode($xValues), json_encode($yValues)]);
        $process->run();

        // Get the output of the Python script
        $output = $process->getOutput();

        // Handle response or redirect as needed
        return response()->json([
            'output' => $output,
        ]);
    }

    public function getPassing(Request $request)
    {
        $valueToSend = "Hello from PHP";

        // $scriptPath = base_path('resources/views/py/test.py');

        // Use shell_exec to run a Python script with the value as a command-line argument
        $output = shell_exec("python test.py " . escapeshellarg($valueToSend));

        // Display the Python script's output (if any)
        echo $output;
    }

}
