<?php

namespace App\Http\Integrations\Connections\Requests;

use App\Http\Integrations\Connections\CodatConnector;
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;

class DeleteConnectionRequest extends SaloonRequest
{
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
    protected ?string $method = Saloon::DELETE;

    public function __construct(
        public string $companyId,
        public string $connectionId
    ) {
    }

    /**
     * The endpoint of the request.
     *
     * @return string
     */
    public function defineEndpoint(): string
    {
        return '/companies/' . $this->companyId . '/connections/' . $this->connectionId;
    }
}
