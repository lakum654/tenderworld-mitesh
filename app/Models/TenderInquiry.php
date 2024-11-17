<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenderInquiry extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function tender() {
        return $this->belongsTo(Tender::class,'tender_id','id')->withDefault(['tender_id' => '-']);
    }
}
