<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KidzavingAccount extends Model
{
    protected $table = 'dbo.KIDZAVING_ACCOUNT';
    protected $primaryKey = 'IdKidzavingsAccount';
    public $timestamps = false;

    protected $fillable = [
        'IdKidzavingAccount', 'CardNumber', 'Balance', 'RegisterDate'
    ];

    public function transactions()
{
    return $this->hasMany(KidzavingTransaction::class, 'IdKidzavingAccount', 'IdKidzavingAccount');
}

public function user()
{
    return $this->belongsTo(KidzavingUser::class, 'IdUniversal', 'IdUniversal');
}


}
