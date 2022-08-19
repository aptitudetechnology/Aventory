<?php

namespace App\Services;

use App\Http\Integrations\Companies\Requests\CreateCompanyRequest;
use App\Http\Integrations\Companies\Requests\DeleteCompanyRequest;
use App\Http\Integrations\Companies\Requests\UpdateCompanyRequest;

class CodatCompaniesService
{
    public function create(array $attributes)
    {
        $request = new CreateCompanyRequest();
        $request->setData($attributes);

        return $request->send()->json();
    }

    public function update($id, array $attributes)
    {
        $request = new UpdateCompanyRequest($id);
        $request->setData($attributes);

        return $request->send()->json();
    }

    public function delete($id)
    {
        $request = new DeleteCompanyRequest($id);

        return $request->send()->json();
    }
}
