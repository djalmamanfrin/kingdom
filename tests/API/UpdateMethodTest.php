<?php

namespace Tests\API;

use App\Models\BankAccount;
use App\Models\Branch;
use App\Models\Church;
use App\Models\Project;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UpdateMethodTest extends TestCase
{
    /**
     * @dataProvider uriAndModelPath
     *
     * @param string $uri
     * @param string $model
     */
    public function testUpdateBankAccountWithHttpPutRequest(string $uri, string $model)
    {
        $id = $model::pluck('id')->random();
        $payload = factory($model)->make()->toArray();
        $response = $this->call('PUT', $uri . $id, $payload);
        $this->assertEquals(Response::HTTP_OK, $response->status());
        $this->seeJsonStructure([]);
    }

    public function testExceptionIfNotInformAllFieldsToUpdateBankAccountWithHttpPutRequest()
    {
        $id = BankAccount::pluck('id')->random();
        $payload = factory(BankAccount::class)->make()->toArray();
        unset($payload['document']);
        $response = $this->call('PUT', self::URI . $id, $payload);
        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $response->status());
        $this->seeJsonStructure($this->getDefaultErrorStructure());
    }

    public function testUpdateBankAccountWithHttpPatchRequest()
    {
        $id = BankAccount::pluck('id')->random();
        $bankAccount = factory(BankAccount::class)->make()->toArray();
        $payload['document'] = $bankAccount['document'];
        $payload['type'] = $bankAccount['type'];
        $response = $this->call('PATCH', self::URI . $id, $payload);
        $this->assertEquals(Response::HTTP_OK, $response->status());
        $this->seeJsonStructure([]);
    }

    public function uriAndModelPath(): array
    {
        return [
            ['api/v1/bank-accounts/', BankAccount::class],
            ['api/v1/branches/', Branch::class],
            ['api/v1/churches/', Church::class],
            ['api/v1/projects/', Project::class],
        ];
    }
}
