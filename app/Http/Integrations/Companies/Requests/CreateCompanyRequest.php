<?php

namespace App\Http\Integrations\Companies\Requests;

use App\Http\Integrations\Companies\CodatConnector;
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Traits\Plugins\HasJsonBody;

class CreateCompanyRequest extends SaloonRequest
{
    use HasJsonBody;

    /**
     * The connector class.
     *
     * @var string|null
     */
    protected ?string $connector = CodatConnector::class;

    /**
     * The HTTP verb the request will use.
     *
     * @var string|null
     */
    protected ?string $method = Saloon::POST;
}
