<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name','description', 'notes', 'data_inizio','data_fine','user_id','client_id','costo_orario'
    ];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
