<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formations extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function formateurs()
    {
        return $this->belongsTo('App\Models\Formateurs');
    }
    
    
    public function evaluations()
    {
        return $this->hasOne(evaluations::class);
    }
    
    public function application()
    {
        return $this->belongsTo('App\Models\Application');
    }
   

}