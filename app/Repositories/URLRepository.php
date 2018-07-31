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

    /**
     * URLRepository constructor.
     * @param URL $model
     */
    public function __construct(URL $model)
    {
        $this->model = $model;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function findAllURLs()
    {
        return $this->model->all();
    }

    /**
     * @param URL $url
     * @return void
     */
    public function delete(URL $url)
    {
        $url->status = URL::STATUS_DELETED;
        $url->save();
    }
}
