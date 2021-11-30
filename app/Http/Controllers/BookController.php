<?php

namespace App\Http\Controllers;

use App\Services\BookService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    use ApiResponser;

    public $bookService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index()
    {
        return $this->successResponse($this->bookService->obtainBooks());
    }

    public function store(Request $request){
        return $this->successResponse($this->bookService->createBooks($request->all()), Response::HTTP_CREATED);
    }

    public function show($author)   
    {
        return $this->successResponse($this->bookService->obtainBook($author));
    }

    public function update(Request $request, $author)
    {
        return $this->successResponse($this->bookService->editBook($request->all(), $author));
    }

    public function destroy($author)
    {
        return $this->successResponse($this->bookService->deleteBook($author));
    }

    
}
