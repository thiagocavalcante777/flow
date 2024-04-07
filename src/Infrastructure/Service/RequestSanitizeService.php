<?php


namespace App\Infrastructure\Service;


use App\Domain\Enum\TimeSleepEnum;

class RequestSanitizeService
{
    public static function sanitize()
    {
        TimeSleepEnum::init();
        return sleep(TimeSleepEnum::$timeSleep);
    }
}
