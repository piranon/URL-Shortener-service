<?php

namespace App\Factories;

use App\Exceptions\URLIsNotValidException;
use App\Models\URL;

/**
 * Class EloquentURLFactory
 * @package App\Factories
 */
class EloquentURLFactory implements URLFactoriesInterface
{
    /**
     * @param $originalUrl
     * @param string $expires
     * @return URL
     * @throws URLIsNotValidException
     */
    public function createURL($originalUrl, $expires = null)
    {
        if (!$this->isURL($originalUrl)) {
            throw new URLIsNotValidException('URL is not valid', 400);
        }

        $url = new URL();
        $url->code = null;
        $url->url = $originalUrl;
        $url->hits = 0;
        $url->status = URL::STATUS_ACTIVE;
        $url->expires_in = null;

        if ($expires !== null) {
            $url->expires_in = new \DateTime($expires);
        }

        return $url;
    }

    /**
     * @param $url
     * @return bool
     */
    private function isURL($url)
    {
        $test = '/^(http|https):\\/\\/[a-z0-9]+([\\-\\.]{1}[a-z0-9]+)*\\.[a-z]{2,5}'.'((:[0-9]{1,5})?\\/.*)?$/i';

        if (preg_match($test, $url)) {
            return true;
        }

        return false;
    }
}
