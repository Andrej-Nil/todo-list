<?php

namespace App\Helpers;

class StatusHelper
{
    public static $statusList = [
        ['id' => 0, 'label' => 'В ожидании'],
        ['id' => 1, 'label' => 'В работе'],
        ['id' => 2, 'label' => 'Приостановлина'],
        ['id' => 3, 'label' => 'Завершена'],
    ];


    public static function getItem($id)
    {
        return collect(self::$statusList)->where('id', $id)->first();
    }

    public static function getName($id)
    {
        $statusItem =  self::getItem($id);
        return $statusItem['label'] ?? '';
    }
}
