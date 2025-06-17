<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KidzavingTransaction extends Model
{
    protected $table = 'dbo.KIDZAVING_TRANSACTION';
    protected $primaryKey = 'IdTransaction';
    public $timestamps = false;

    protected $fillable = [
        'IdTransaction', 'IdKidzavingAccount' , 'IdTransactionType', 'Amount', 'TransactionDate'
    ];

    public function transactionType()
    {
        return $this->belongsTo(TransactionType::class, 'IdTransactionType', 'IdTransactionType');
    }

    public function account()
    {
        return $this->belongsTo(KidzavingAccount::class, 'IdKidzavingAccount', 'IdKidzavingAccount');
    }
}
