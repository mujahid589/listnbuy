<?php

namespace Modules\OurTeam\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OurTeam extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table= "ourteams";

    protected static function newFactory()
    {
        return \Modules\OurTeam\Database\factories\OurTeamFactory::new();
    }
}
