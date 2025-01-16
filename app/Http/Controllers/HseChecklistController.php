<?php

namespace App\Http\Controllers;

use App\Models\HseChecklist;
use Illuminate\Http\Request;

class HseChecklistController extends Controller
{
    public function index(Request $request)
    {
        $query = HseChecklist::query();

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        if ($request->filled('reported_by')) {
            $query->where('reported_by', $request->reported_by);
        }

        if ($request->filled('status')) {
            if ($request->status === 'not_accept') {
                $query->whereNull('feedback')->orWhere('feedback', '');
            } else {
                $query->where('feedback', $request->status);
            }
        }

        $reports = $query->get();

        $reporters = HseChecklist::select('reported_by')->distinct()->pluck('reported_by');

        return view('report.data', compact('reports', 'reporters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reported_by' => 'required|string',
            'date' => 'required|date',
            'inst_dept' => 'required|string',
            'condition_status' => 'required|string',

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
        $report = HseChecklist::findOrFail($id);

        $action = 'approve';

        return view('report.show', compact('report', 'action'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        $report = HseChecklist::findOrFail($id);

        $action = $request->route()->getName() === 'hse_report.approve' ? 'approve' : 'reject';

        $report->update([
            'feedback' => $action,
            'reason' => $validated['reason'],
        ]);

        return redirect()
            ->route('hse_report.show', $id)
            ->with('success', ucfirst($action) . ' berhasil diproses!');
    }

    public function approve(Request $request, $id)
    {
        return $this->processAction($request, $id, 'approve');
    }

    public function reject(Request $request, $id)
    {
        return $this->processAction($request, $id, 'reject');
    }

    private function processAction(Request $request, $id, $action)
    {
        $validated = $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        $report = HseChecklist::findOrFail($id);

        $report->update([
            'feedback' => $action,
            'reason' => $validated['reason'],
        ]);

        return redirect()
            ->route('hse_report.show', $id)
            ->with('success', ucfirst($action) . ' berhasil diproses!');
    }
}
