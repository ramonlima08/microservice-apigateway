<?php

namespace App\Service;

use App\Traits\ConsumesExternalServices;

class AuthorService
{
    use ConsumesExternalServices;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.authors.base_uri');
    }

}