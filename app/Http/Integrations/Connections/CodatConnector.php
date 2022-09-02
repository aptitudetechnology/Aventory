<?php

namespace App\Http\Integrations\Connections;

use Sammyjo20\Saloon\Http\SaloonConnector;
use Sammyjo20\Saloon\Traits\Plugins\AcceptsJson;
use Sammyjo20\Saloon\Traits\Plugins\AlwaysThrowsOnErrors;

class CodatConnector extends SaloonConnector
{
    use AcceptsJson;
    use AlwaysThrowsOnErrors;

    /**
     * The Base URL of the API.
     *
     * @return string
     */
    public function defineBaseUrl(): string
    {
        return config('app.codat_url');
    }

    /**
     * The headers that will be applied to every request.
     *
     * @return string[]
     */
    public function defaultHeaders(): array
    {
        return [
            'Authorization' => config('app.codat_auth_header'),
            'Content-Type' => 'application/json',
        ];
    }

    /**
     * The config options that will be applied to every request.
     *
     * @return string[]
     */
    public function defaultConfig(): array
    {
        return [
            'timeout' => 30,
        ];
    }
}
