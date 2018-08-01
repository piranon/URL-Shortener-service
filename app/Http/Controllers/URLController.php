<?php

namespace App\Http\Controllers;

use App\Factories\URLFactoriesInterface;
use App\Services\URLService;
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
     * @var URLService
     */
    private $URLService;

    /**
     * URLController constructor.
     * @param URLFactoriesInterface $URLFactory
     * @param URLService $URLService
     */
    public function __construct(
        URLFactoriesInterface $URLFactory,
        URLService $URLService
    ) {
        $this->URLFactory = $URLFactory;
        $this->URLService = $URLService;
    }

    /**
     * @param Request $request
     * @return string
     */
    public function create(Request $request)
    {
        $originalURL = $request->input('url');
        $expires = $request->input('expires');

        $url = $this->URLFactory->createURL($originalURL, $expires);
        $this->URLService->generateCode($url);

        return response()->json(['success' => true], 201);
    }
}
