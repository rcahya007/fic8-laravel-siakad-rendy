<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    // index
    public function index()
    {
        $subjects = Subject::paginate(10);
        return view('pages.subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('pages.subjects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:subjects,name',
            'description' => 'required',
            'lecturer_id' => 'required|exists:users,id',
        ]);

        Subject::create($request->all());
        return redirect()->route('')->with('success', 'Subject created successfully');
    }
}
