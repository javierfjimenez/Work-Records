<?php


use App\Jobs\ExportWorkRecordsJob;
use App\Models\User;
use App\Models\WorkRecord;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;


uses(RefreshDatabase::class);

it('exports work records to a CSV file', function () {
    $user = User::factory()->create();
    WorkRecord::factory()->count(3)->create(['user_id' => $user->id]);

    dispatch(new ExportWorkRecordsJob($user));

    // Darle tiempo a la queue para procesar el job
    $this->artisan('queue:work --stop-when-empty');

    // Verificar si el archivo se creó en storage_path()
    $filePath = storage_path("app/exports/work_records_{$user->id}.csv");
    // Verifica en la ruta real
    $this->assertFileExists($filePath); 
});