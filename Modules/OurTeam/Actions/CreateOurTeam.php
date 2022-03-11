<?php

namespace Modules\OurTeam\Actions;

use App\Actions\File\FileUpload;
use Modules\OurTeam\Entities\OurTeam;

class CreateOurTeam
{
    public static function create($request)
    {
        $ourteam = OurTeam::create($request->all());

        $image = $request->image;
        if ($image) {
            $url = FileUpload::upload($image, 'ourteam');
            $ourteam->update(['image' => $url]);
        }

        return $ourteam;
    }
}
