<?php
namespace App\Service;

use Aws\Ses\SesClient;

class sesClientService
{
    /**
     *
     * @return SesClient
     */
    static function getSESClient()
    {
        return new SesClient([
            'credentials' => [
                'key'    => 'x',
                'secret' => 'x',
            ],
            'version' => 'latest',
            'region' => 'eu-west-1'
        ]);
    }
}