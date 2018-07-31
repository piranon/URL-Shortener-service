<?php
namespace App\Repositories;

use App\Models\URL;

/**
 * Class URLRepository
 * @package App\Repositories
 */
class URLRepository implements URLRepositoryInterface
{
    /**
     * @var URL
     */
    private $model;

    public function __construct(URL $model)
    {
        $this->model = $model;
    }

    public function findAllURLs()
    {
        return $this->model->all();
    }
}
