<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkRecordRequest;
use App\Jobs\ExportWorkRecordsJob;
use App\Models\WorkRecord;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class WorkRecordController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $workRecords = WorkRecord::byUser(auth()->id())->latest()->paginate(5);
        return view('work_records.index', compact('workRecords'));
    }

    public function create()
    {
        return view('work_records.form');
    }

    public function store(WorkRecordRequest $request)
    {
        auth()->user()->workRecords()->create($request->validated());
        return redirect()->route('work_records.index')->with('success', 'Registro creado correctamente');
    }

    public function show(WorkRecord $workRecord)
    {
        $this->authorize('view', $workRecord);
        return view('work_records.show', compact('workRecord'));
    }

    public function edit(WorkRecord $workRecord)
    {
        $this->authorize('update', $workRecord);
        return view('work_records.form', compact('workRecord'));
    }

    public function update(WorkRecordRequest $request, WorkRecord $workRecord)
    {
        $this->authorize('update', $workRecord);
        $workRecord->update($request->validated());
        return redirect()->route('work_records.index')->with('success', 'Registro actualizado');
    }

    public function destroy(WorkRecord $workRecord)
    {
        $this->authorize('delete', $workRecord);
        $workRecord->delete();
        return redirect()->route('work_records.index')->with('success', 'Registro eliminado');
    }

    public function export(Request $request)
    {
        // Lanzar el Job en segundo plano
        ExportWorkRecordsJob::dispatch($request->user());

        return redirect()->back()->with('status', 'La exportación está en proceso. Recibirás un correo con el archivo CSV.');
    }
}
