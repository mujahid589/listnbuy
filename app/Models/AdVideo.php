<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Ad\Entities\Ad;

class AdVideo extends Model
{
    //use HasFactory;

    protected $table='ad_videos';

    protected $guarded = [];

    /**
     * Undocumented function
     *
     * @return BelongsTo
     */
    public function ads(): BelongsTo
    {
        return $this->belongsTo(Ad::class, 'ad_id');
    }
}
