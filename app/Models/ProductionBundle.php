<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductionBundle extends Model
{
   use SoftDeletes;

    protected $fillable = [
        'bundle_no',
        'buyer_id',
        'style_id',
        'line_id',
        'color',
        'size',
        'quantity',
        'completed_qty',
        'rejected_qty',
        'operator_name',
        'production_date',
        'remarks'
    ];

    public function buyer(): BelongsTo
    {
        return $this->belongsTo(Buyer::class);
    }

    public function style(): BelongsTo
    {
        return $this->belongsTo(Style::class);
    }

    public function line(): BelongsTo
    {
        return $this->belongsTo(SewingLine::class,'line_id');
    }
}
