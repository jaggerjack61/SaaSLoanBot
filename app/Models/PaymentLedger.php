<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentLedger extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function loan():belongsTo
    {
        return $this->belongsTo(LoanHistory::class,'loan_id');
    }
    public function handler():belongsTo
    {
        return $this->belongsTo(User::class,'handled_by');
    }
}
