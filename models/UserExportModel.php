<?php namespace VojtaSvoboda\UserImportExport\Models;

use Backend\Models\ExportModel;
use RainLab\User\Models\User;

class UserExportModel extends ExportModel
{
    public function exportData($columns, $sessionKey = null)
    {
        $return = [];
        $users = User::all();
        $users->each(function($user) use ($columns, &$return) {
            $user->addVisible($columns);
            $array = $user->toArray();
            if ($user->country && $user->country->name) {
                $array['country_id'] = $user->country->name;
            }
            $return[] = $array;
        });

        return $return;
    }
}
