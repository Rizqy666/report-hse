<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HseChecklist extends Model
{
    use HasFactory;

    protected $table = 'hse_checklists';
    protected $fillable = ['reported_by', 'date', 'inst_dept', 'condition_status', 'ppe', 'ppe_notes', 'working_position', 'working_position_notes', 'ergonomic', 'ergonomic_notes', 'tools', 'tools_notes', 'procedures', 'procedures_notes', 'environment', 'environment_notes'];

    // Dekode JSON ketika mengambil data dari database
    protected $casts = [
        'ppe' => 'array',
        'ppe_notes' => 'array',
        'working_position' => 'array',
        'working_position_notes' => 'array',
        'ergonomic' => 'array',
        'ergonomic_notes' => 'array',
        'tools' => 'array',
        'tools_notes' => 'array',
        'procedures' => 'array',
        'procedures_notes' => 'array',
        'environment' => 'array',
        'environment_notes' => 'array',
    ];
}
