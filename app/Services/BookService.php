<?php

namespace App\Service;

use App\Traits\ConsumesExternalServices;

class BookService
{
    use ConsumesExternalServices;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.books.base_uri');
    }

}