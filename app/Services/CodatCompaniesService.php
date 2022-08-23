<?php

namespace App\Services;

use App\Http\Integrations\Companies\Requests\CreateCompanyRequest;
use App\Http\Integrations\Companies\Requests\DeleteCompanyRequest;
use App\Http\Integrations\Companies\Requests\UpdateCompanyRequest;

class CodatCompaniesService
{
    public function create(array $data)
    {
        $request = new CreateCompanyRequest();
        $request->setData($data);

        return $request->send()->json();
    }

    public function update($id, array $data)
    {
        $request = new UpdateCompanyRequest($id);
        $request->setData($data);

        return $request->send()->json();
    }

    public function delete($id)
    {
        $request = new DeleteCompanyRequest($id);

        return $request->send()->json();
    }
}
