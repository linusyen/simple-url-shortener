<?php

namespace App\Http\Controllers;

use App\Services\UrlService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class UrlController extends BaseController
{
    /**
     * @var UrlService
     */
    private $urlService;

    public function __construct(UrlService $urlService)
    {
        $this->urlService = $urlService;
    }

    public function index()
    {
        return view('index');
    }

    public function redirect($key)
    {
        if ($this->urlService->isValidatedKey($key)) {
            $url = $this->urlService->getUrlByKey($key);
            if (!empty($url)) {
                $protocol = '';
                if (strpos($url, 'http://') !== 0 && strpos($url, 'https://') !== 0) {
                    $protocol = 'http://';
                }
                return redirect($protocol . $url);
            }
        }
        return redirect('/');
    }

    public function store(Request $request)
    {
        $url = trim($request->post('url'));
        $mappingKey = $this->urlService->saveUrl($url);
        $data = [
            'key' => $mappingKey,
            'url' => $url,
            'short_url' => url($mappingKey),
        ];

        return response()->json($data, 200);
    }
}
