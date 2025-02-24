<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class WorkRecordsExportMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function build()
    {
        return $this->subject('Reporte de trabajos freelance en CSV')
            ->view('emails.work_records_export')
            ->attach(storage_path("app/{$this->filePath}"), [
                'as' => 'work_records.csv',
                'mime' => 'text/csv',
            ]);
    }
}