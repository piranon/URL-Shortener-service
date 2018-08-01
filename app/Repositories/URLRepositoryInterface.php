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

    /**
     * @param URL $url
     */
    public function delete(URL $url);

    /**
     * @param array $values
     * @return URL[]
     */
    public function search(array $values);

    /**
     * @param URL $url
     */
    public function save(URL $url);

    /**
     * @param string $code
     * @return URL
     */
    public function findByCode($code);
}
