<?php

namespace App\Factories;

use App\Models\URL;

/**
 * Interface URLFactoriesInterface
 * @package App\Factories
 */
interface URLFactoriesInterface
{
    /**
     * @param $originalUrl
     * @param string $expires
     * @return URL
     */
    public function createURL($originalUrl, $expires = '');
}
