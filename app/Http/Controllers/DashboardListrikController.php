<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataListrik;

class DashboardListrikController extends Controller
{
    public function index()
    {
        // Fetch existing records or create empty rows for the table (5 rows)
        $dataListriks = DataListrik::orderBy('id')->take(5)->get();

        // If there are less than 5 rows, create empty ones
        for ($i = $dataListriks->count(); $i < 5; $i++) {
            $dataListriks->push(new DataListrik());
        }

        return view('admin.datalistrik', compact('dataListriks'));
    }
    public function indexhome()
    {
        // Fetch existing records or create empty rows for the table (5 rows)
        $dataListriks = DataListrik::orderBy('id')->take(5)->get();

        // If there are less than 5 rows, create empty ones
        for ($i = $dataListriks->count(); $i < 5; $i++) {
            $dataListriks->push(new DataListrik());
        }

        return view('home', compact('dataListriks'));
    }

    public function indexubah()
    {
        // Fetch existing records or create empty rows for the table (5 rows)
        $dataListriks = DataListrik::orderBy('id')->take(5)->get();

        // If there are less than 5 rows, create empty ones
        for ($i = $dataListriks->count(); $i < 5; $i++) {
            $dataListriks->push(new DataListrik());
        }

        return view('admin.ubah-listrik', compact('dataListriks'));
    }

    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'data' => 'array', // Ensure 'data' is an array
            'data.*.date' => 'nullable|date',
            'data.*.time' => 'nullable',
            'data.*.daya_listrik' => 'nullable|string|max:255',
            'data.*.status' => 'required|in:Updated,Not Updated'
        ]);

        // Clear the existing data
        DataListrik::truncate();

        // Save new data from the request
        foreach ($request->data as $row) {
            DataListrik::create([
                'date' => $row['date'] ?? null,
                'time' => $row['time'] ?? null,
                'daya_listrik' => $row['daya_listrik'] ?? null,
                'status' => $row['status']
            ]);
        }

        return redirect()->route('ubah-listrik.indexubah')->with('success', 'Data berhasil disimpan!');
    }
}
