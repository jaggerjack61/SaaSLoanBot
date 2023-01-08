<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoanHistory extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function owner():belongsTo
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }

    public function handler():belongsTo
    {
        return $this->belongsTo(User::class,'handled_by');
    }
    public function payments()
    {
        return $this->hasMany(PaymentLedger::class,'id','loan_id');
    }
}
