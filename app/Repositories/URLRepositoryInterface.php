<?php
namespace App\Repositories;

use App\Models\URL;

/**
 * Interface URLRepositoryInterface
 * @package App\Repositories
 */
interface URLRepositoryInterface
{
    /**
     * @return URL[]
     */
    public function findAllURLs();
}
