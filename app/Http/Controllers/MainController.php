<?php

namespace App\Http\Controllers;

use App\Http\Requests\SectionRequest;
use App\Services\StringService;
use Illuminate\Http\Response;

class MainController extends Controller
{
    private StringService $stringService;

    public function __construct(StringService $stringService)
    {
        $this->stringService = $stringService;
    }

    public function section1()
    {
        return view('sections.section1');
    }

    public function section1Store(SectionRequest $request)
    {
        $validated = $request->validated();
        $length = $this->stringService->calculateLength($validated);

        return $this->jsonResponse($length, Response::HTTP_OK);
    }
}