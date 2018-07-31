<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\URL;
use App\Repositories\URLRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

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
     * @param URL $url
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(URL $url)
    {
        if ($url->status === URL::STATUS_DELETED || $url->status === URL::STATUS_EXPIRED) {
            throw (new ModelNotFoundException)->setModel('URL');
        }

        $this->URLRepository->delete($url);

        return response()->json(['success' => true], 202);
    }
}
