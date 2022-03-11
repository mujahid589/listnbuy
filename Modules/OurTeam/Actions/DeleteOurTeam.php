<?php

namespace Modules\OurTeam\Actions;

class DeleteOurTeam
{
    public static function delete($ourteam)
    {
        $ourteamImage = file_exists($ourteam->image);

        if ($ourteamImage) {
            deleteImage($ourteam->image);
        }

        return $ourteam->delete();
    }
}
