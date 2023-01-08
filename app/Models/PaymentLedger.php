<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentLedger extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function loan()
    {
        return $this->belongsTo(LoanHistory::class,'loan_id');
    }
}
