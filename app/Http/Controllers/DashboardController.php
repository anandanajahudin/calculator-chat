<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operation;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.front.index');
    }

    public function dashboard()
    {
        $operations = Operation::all();
        return view('pages.back.dashboard', ['operations' => $operations]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //validate form
        // $this->validate($request, [
        //     'name' => 'required',
        //     'nickname' => 'required',
        //     'grade_number' => 'required',
        // ]);

        // //save
        // Student::create([
        //     'name' => $request->name,
        //     'nickname' => $request->nickname,
        //     'grade_number' => $request->grade_number,
        // ]);

        // //redirect to index
        // return redirect()->route('student')->with(['success' => 'Student Data has been saved!']);
    }

    public function show(string $id)
    {
        //
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