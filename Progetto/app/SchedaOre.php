<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchedaOre extends Model
{
    protected $fillable=['data_scheda',
    'hours_work',
    'note',
    'project_name'];
}
