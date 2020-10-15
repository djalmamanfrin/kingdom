<?php

namespace Tests\API\BankAccountController;

use App\Models\BankAccount;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class GetMethodTest extends TestCase
{
    private const URI = 'api/v1/bank-accounts/';

    public function testExpectedErrorIfIdNotInformed()
    {
        $response = $this->call('GET', self::URI);
        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $response->status());
        $this->seeJsonStructure($this->getDefaultErrorStructure());
    }

    public function testExpectedJsonStructureInTheMethod()
    {
        $id = BankAccount::pluck('id')->random();
        $response = $this->call('GET', self::URI . $id);
        $this->assertEquals(Response::HTTP_OK, $response->status());
        $this->seeJsonStructure($this->getDefaultSuccessStructure());
    }
}
