<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\ExportWorkRecordsJob;
use App\Models\WorkRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class WorkRecordController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        return response()->json(Auth::user()->workRecords);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'priority' => 'required|in:baja,media,alta',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
        ]);

        $record = Auth::user()->workRecords()->create($validated);

        return response()->json($record, 201);
    }

    public function show(WorkRecord $workRecord)
    {
        $this->authorize('view', $workRecord);
        return response()->json($workRecord);
    }

    public function update(Request $request, WorkRecord $workRecord)
    {
        $this->authorize('update', $workRecord);

        $validated = $request->validate([
            'title' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
            'priority' => 'required|in:baja,media,alta',
            'description' => 'nullable|string',
        ]);

        $workRecord->update($validated);

        return response()->json($workRecord);
    }

    public function destroy(WorkRecord $workRecord)
    {
        $this->authorize('delete', $workRecord);

        $workRecord->delete();

        return response()->json(['message' => 'Registro De Trabajo Eliminado']);
    }

    public function export(Request $request)
    {
        // Lanzar el Job en segundo plano
        ExportWorkRecordsJob::dispatch($request->user());
    
        return response()->json(['success' => true ,'message' => 'La exportación está en proceso. Recibirás un correo con el archivo CSV.']);
    }
}