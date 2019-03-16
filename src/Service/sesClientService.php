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
                'key'    => 'AKIAIUSP5O7BGP6GW6YA',
                'secret' => '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',
            ],
            'version' => 'latest',
            'region' => 'eu-west-1'
        ]);
    }
}