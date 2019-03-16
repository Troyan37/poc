<?php
namespace App\Service;

class calculateBounceService
{
    /**
     * @param $result
     * @return int
     */
    static function getBounce($result)
    {
        $totalBounces = 0;
        foreach ($result['SendDataPoints'] as $sendDataPoint) {
            if (self::hasStatisticsToday($sendDataPoint)) {
                if ($sendDataPoint['Bounces'] > 0) {
                    $totalBounces += intval($sendDataPoint['Bounces']);
                }
            }
        }
        return $totalBounces;
    }
    /**
     * @param $sendDataPoint
     * @return bool
     */
    static function hasStatisticsToday($sendDataPoint)
    {
        return date('Ymd') == date('Ymd', strtotime($sendDataPoint['Timestamp']));
    }
}