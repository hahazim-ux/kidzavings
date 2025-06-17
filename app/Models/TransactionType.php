<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    protected $table = 'dbo.TRANSACTION_TYPE';
    protected $primaryKey = 'IdTransactionType';
    public $timestamps = false;

    protected $fillable = [
        'IdTransactionType', 'Description'
    ];
}
