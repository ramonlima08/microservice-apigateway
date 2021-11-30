<?php

namespace App\Services;

use App\Traits\ConsumesExternalServices;

class BookService
{
    use ConsumesExternalServices;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.books.base_uri');
    }

    public function obtainBooks()
    {
        return $this->performRequest('GET', '/books');
    }

    public function createBooks($data)
    {
        return $this->performRequest('POST', '/books', $data);
    }

    public function obtainBook($author)
    {
        return $this->performRequest('GET', "/books/{$author}");
    }

    public function editBook($data, $author)
    {
        return $this->performRequest('PUT', "/books/{$author}", $data);
    }

    public function deleteBook($author)
    {
        return $this->performRequest('DELETE', "/books/{$author}");
    }

}