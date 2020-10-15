<?php

namespace Tests\API\BankAccountController;

use App\Models\BankAccount;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UpdateMethodTest extends TestCase
{
    private const URI = 'api/v1/bank-accounts/';

    public function testUpdateBankAccountWithHttpPutRequest()
    {
        $id = BankAccount::pluck('id')->random();
        $payload = factory(BankAccount::class)->make()->toArray();
        $response = $this->call('PUT', self::URI . $id, $payload);
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
}
