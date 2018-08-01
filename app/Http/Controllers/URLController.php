<?php

namespace App\Http\Controllers;

use App\Factories\URLFactoriesInterface;
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
     * URLController constructor.
     * @param URLFactoriesInterface $URLFactory
     */
    public function __construct(URLFactoriesInterface $URLFactory)
    {
        $this->URLFactory = $URLFactory;
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
        $url->save();

        return response()->json(['success' => true], 201);
    }
}
