<?php

namespace App\Http\Controllers;

use App\Repositories\ChatRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    private ChatRepository $sectionRepository;

    public function __construct(ChatRepository $sectionRepository)
    {
        $this->sectionRepository = $sectionRepository;
    }

    public function index()
    {
        return view('sections.chat', [
            'messages' => $this->sectionRepository->getAll()
        ]);
    }

    public function store(Request $request)
    {
        $message = $request->input('message');

        try {
            $this->sectionRepository->save($message);
        } catch (\Exception $exception) {
            Log::critical($exception->getMessage());
            return $this->jsonResponse($exception->getMessage(), $exception->getCode());
        }

        return $this->jsonResponse($message, Response::HTTP_OK);
    }
}