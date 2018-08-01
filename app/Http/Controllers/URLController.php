<?php

namespace App\Http\Controllers;

use App\Factories\URLFactoriesInterface;
use App\Repositories\URLRepositoryInterface;
use Illuminate\Http\Request;

/**
 * Class URLController
 * @package App\Http\Controllers
 */
class URLController extends Controller
{
    /**
     * @var URLFactoriesInterface
     */
    private $URLFactory;

    /**
     * @var URLRepositoryInterface
     */
    private $URLRepository;

    /**
     * URLController constructor.
     * @param URLFactoriesInterface $URLFactory
     * @param URLRepositoryInterface $repository
     */
    public function __construct(URLFactoriesInterface $URLFactory, URLRepositoryInterface $repository)
    {
        $this->URLFactory = $URLFactory;
        $this->URLRepository = $repository;
    }

    /**
     * @param Request $request
     * @return string
     */
    public function create(Request $request)
    {
        $originalURL = $request->input('url');
        $expire = $request->input('expire');

        $url = $this->URLFactory->createURL($originalURL, $expire);
        $url->code = 'TEST';

        $this->URLRepository->save($url);

        return response()->json(['success' => true], 201);
    }
}
