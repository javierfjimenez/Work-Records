<?php

namespace App\Jobs;

use App\Models\WorkRecord;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\WorkRecordsExportMail;

class ExportWorkRecordsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function handle()
{
    $directory = storage_path('app/exports');

    // Verificar si la carpeta existe, si no, crearla
    if (!is_dir($directory)) {
        mkdir($directory, 0755, true);
    }

    $filePath = "exports/work_records_{$this->user->id}.csv";

    // Obtener los registros de trabajo del usuario
    $workRecords = WorkRecord::where('user_id', $this->user->id)->get();

    // Crear archivo CSV en almacenamiento
    $csv = fopen(storage_path("app/{$filePath}"), 'w');

    // Escribir encabezados
    fputcsv($csv, ['ID','Título', 'Descripción', 'Inicio', 'Fin', 'Prioridad']);

    foreach ($workRecords as $record) {
        fputcsv($csv, [
            $record->id,
            $record->title,
            $record->description,
            $record->start_time?? 'No definido',
            $record->end_time ?? 'No definido',
            ucfirst($record->priority),
        ]);
    }

    fclose($csv);

    
    // Enviar el correo con el CSV adjunto
    Mail::to($this->user->email)->send(new WorkRecordsExportMail($filePath));

    // Eliminar el archivo después de enviarlo
    Storage::delete($filePath);
}
}