<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'ragione_sociale', 'nome_referente', 'cognome_referente','Email_referente','SSID','PEC','PIVA'
    ];
}
