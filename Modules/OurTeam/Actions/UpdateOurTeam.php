<?php

namespace Modules\OurTeam\Actions;

use App\Actions\File\FileUpload;

class UpdateOurTeam
{
    public static function update($request, $ourteam)
    {
        $ourteam->update($request->all());

        $image = $request->image;
        if ($image) {
            $url = FileUpload::upload($image, 'ourteam');
            $ourteam->update(['image' => $url]);
        }

        return $ourteam;
    }
}
