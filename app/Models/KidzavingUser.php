<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KidzavingUser extends Model
{
    protected $table = 'dbo.ENC_VISITOR';
    protected $primaryKey = 'IdUniversal';
    public $timestamps = false;

    protected $fillable = [
        'IdUniversal' , 'Name' , 'LastName'
    ];

}
