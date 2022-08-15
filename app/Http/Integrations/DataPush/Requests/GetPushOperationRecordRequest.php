<?php

namespace App\Http\Integrations\DataPush\Requests;

use App\Http\Integrations\DataPush\CodatConnector;
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;

class GetPushOperationRecordRequest extends SaloonRequest
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
    protected ?string $method = Saloon::GET;

    public function __construct(
        public string $companyId,
        public string $pushOperationKey
    ) {
    }

    /**
     * The endpoint of the request.
     *
     * @return string
     */
    public function defineEndpoint(): string
    {
        return "/{$this->companyId}/push/{$this->pushOperationKey}";
    }
}
