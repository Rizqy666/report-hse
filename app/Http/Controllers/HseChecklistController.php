<?php

namespace App\Http\Controllers;

use App\Models\HseChecklist;
use Illuminate\Http\Request;

class HseChecklistController extends Controller
{
    public function index(Request $request)
    {
        // Menyiapkan query builder untuk tabel HSE
        $query = HseChecklist::query();

        // Memeriksa apakah ada parameter 'start_date' dan 'end_date' yang dikirimkan dalam request
        if ($request->has('start_date') && $request->has('end_date')) {
            // Filter berdasarkan range tanggal
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        // Ambil data yang sudah difilter
        $reports = $query->get();

        // Kirim data ke view
        return view('report.data', compact('reports'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reported_by' => 'required|string',
            'date' => 'required|date',
            'inst_dept' => 'required|string',
            'condition_status' => 'nullable|string',

            'ppe' => 'nullable|array',
            'ppe_notes' => 'nullable|array',

            'working_position' => 'nullable|array',
            'working_position_notes' => 'nullable|array',

            'ergonomic' => 'nullable|array',
            'ergonomic_notes' => 'nullable|array',

            'tools' => 'nullable|array',
            'tools_notes' => 'nullable|array',

            'procedures' => 'nullable|array',
            'procedures_notes' => 'nullable|array',

            'environment' => 'nullable|array',
            'environment_notes' => 'nullable|array',
        ]);

        // Menyimpan data checklist
        HseChecklist::create([
            'reported_by' => $request->reported_by,
            'date' => $request->date,
            'inst_dept' => $request->inst_dept,
            'condition_status' => $request->condition_status,

            'ppe' => $request->ppe ?? [],
            'ppe_notes' => $request->ppe_notes ?? [],

            'working_position' => $request->working_position ?? [],
            'working_position_notes' => $request->working_position_notes ?? [],

            'ergonomic' => $request->ergonomic ?? [],
            'ergonomic_notes' => $request->ergonomic_notes ?? [],

            'tools' => $request->tools ?? [],
            'tools_notes' => $request->tools_notes ?? [],

            'procedures' => $request->procedures ?? [],
            'procedures_notes' => $request->procedures_notes ?? [],

            'environment' => $request->environment ?? [],
            'environment_notes' => $request->environment_notes ?? [],
        ]);

        return redirect()->back()->with('success', 'Formulir berhasil disubmit!');
    }

    public function show($id)
    {
        // Ambil satu data berdasarkan id
        $report = HseChecklist::findOrFail($id);

        // Kirim data ke view
        return view('report.show', compact('report')); // Kirim data dengan nama 'report'
    }
}
