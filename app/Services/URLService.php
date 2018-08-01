<?php

namespace App\Services;

use App\Models\URL;
use App\Repositories\URLRepositoryInterface;
use Hashids\Hashids;

/**
 * Class URLService
 * @package App\Factories
 */
class URLService
{
    /**
     * @var Hashids
     */
    private $hashids;

    /**
     * @var URLRepositoryInterface
     */
    private $URLRepository;

    /**
     * URLService constructor.
     * @param Hashids $hashids
     * @param URLRepositoryInterface $repository
     */
    public function __construct(Hashids $hashids, URLRepositoryInterface $repository)
    {
        $this->hashids = $hashids;
        $this->URLRepository = $repository;
    }

    /**
     * @param URL $url
     * @return URL
     */
    public function generateCode(URL $url)
    {
        $this->URLRepository->save($url);
        $url->code = $this->hashids->encode((int) $url->id);
        $this->URLRepository->save($url);
        return $url;
    }
}
