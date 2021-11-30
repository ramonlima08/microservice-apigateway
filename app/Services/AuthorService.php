<?php

namespace App\Services;

use App\Traits\ConsumesExternalServices;

class AuthorService
{
    use ConsumesExternalServices;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.authors.base_uri');
    }

    public function obtainAuthors()
    {
        return $this->performRequest('GET', '/authors');
    }

    public function createAuthors($data)
    {
        return $this->performRequest('POST', '/authors', $data);
    }

    public function obtainAuthor($author)
    {
        return $this->performRequest('GET', "/authors/{$author}");
    }

}