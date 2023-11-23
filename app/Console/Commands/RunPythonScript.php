<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RunPythonScript extends Command
{
    protected $signature = 'python:run';
    protected $description = 'Run a Python script within Laravel';

    public function handle()
    {
        $scriptPath = base_path('resources/views/pages/back/test.py');
        $output = [];
        $exitCode = 0;

        exec("python {$scriptPath}", $output, $exitCode);

        $this->info(implode("\n", $output));

        if ($exitCode !== 0) {
            $this->error("Python script execution failed with exit code: {$exitCode}");
        }
    }
}
