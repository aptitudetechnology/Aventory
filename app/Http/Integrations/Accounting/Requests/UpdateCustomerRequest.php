<?php

namespace App\Http\Integrations\Accounting\Requests;

use App\Http\Integrations\Accounting\CodatConnector;
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Traits\Plugins\HasJsonBody;

class UpdateCustomerRequest extends SaloonRequest
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
        public string $connectionId,
        public string $customerId
    ) {
    }

    /**
     * The endpoint of the request.
     *
     * @return string
     */
    public function defineEndpoint(): string
    {
        return "/companies/{$this->companyId}/connections/{$this->connectionId}/push/customers/{$this->customerId}";
    }
}
