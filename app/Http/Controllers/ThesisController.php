<?php

namespace App\Http\Controllers;

use App\Models\Thesis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ThesisController extends Controller
{
    public function index()
    {
        $theses = Thesis::orderBy('id', 'ASC')->get();
        return view('theses.index', compact('theses'));
    }

    public function store(Request $request)
    {
        Thesis::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->back()
            ->with('success', 'Thesis created successfully');
    }

    public function update(Request $request, $id)
    {
        DB::table('theses')->Where('id', $request->id)->update([
            'title' => $request->title,
            'description' => $request->description
        ]);

        return redirect()->back()
            ->with('success', 'Thesis updated successfully');
    }
}
