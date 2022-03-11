<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Ad\Entities\Ad;

class VehicleFeatures extends Model
{
    use HasFactory;
    protected $table= "vehicle_features";

    protected $fillable = ['vehicle_body_type','vehicle_make','milage','transmission_type','fuel_type','title_status'];
    /**
     * User feactures Pricing Plan
     *
     * @return BelongsTo
     *
     */
    public function ads(): BelongsTo
    {
        return $this->belongsTo(Ad::class, 'ads_id');
    }
}
