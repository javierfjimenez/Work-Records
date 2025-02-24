<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class WorkRecord extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'title', 'description', 'priority', 'start_time', 'end_time'];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeByUser(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId);
    }

    public function scopeByDate(Builder $query, $startDate, $endDate): Builder
    {
        return $query->whereBetween('start_time', [
            Carbon::parse($startDate)->startOfDay(),
            Carbon::parse($endDate)->endOfDay(),
        ]);
    }

    // Accessor para obtener prioridad con formato e icono
    public function getPriorityLabelAttribute(): string
    {
        return match ($this->priority) {
            'alta' => '🔴 Alta',
            'media' => '🟡 Media',
            'baja' => '🟢 Baja',
            default => 'Desconocida',
        };
    }

    // Excluir registros eliminados por defecto
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('excludeDeleted', function (Builder $builder) {
            $builder->withoutTrashed();
        });
    }
}
