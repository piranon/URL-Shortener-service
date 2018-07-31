<?php

namespace App\Http\Controllers\Admin;

use App\Models\URL;
use Illuminate\Http\Request;
use App\Repositories\URLRepositoryInterface;
use App\Http\Controllers\Controller;

/**
 * Class AdminURLController
 * @package App\Http\Controllers\Admin
 */
class AdminURLController extends Controller
{
    /**
     * @var URLRepositoryInterface
     */
    private $URLRepository;

    /**
     * AdminURLController constructor.
     * @param URLRepositoryInterface $repository
     */
    public function __construct(URLRepositoryInterface $repository)
    {
        $this->URLRepository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->URLRepository->findAllURLs());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * @param URL $url
     * @return URL
     */
    public function destroy(URL $url)
    {
        return response()->json(['message' => $url]);
    }
}
