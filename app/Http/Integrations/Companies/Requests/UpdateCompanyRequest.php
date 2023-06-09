<?php

namespace App\Http\Integrations\Companies\Requests;

use App\Http\Integrations\Companies\CodatConnector;
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Traits\Plugins\HasJsonBody;

class UpdateCompanyRequest extends SaloonRequest
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
    protected ?string $method = Saloon::PUT;

    public function __construct(
        public string $companyId,
    ) {
    }

    /**
     * The endpoint of the request.
     *
     * @return string
     */
    public function defineEndpoint(): string
    {
        return $this->companyId;
    }
}
