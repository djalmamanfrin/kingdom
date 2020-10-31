<?php

namespace Tests\API\BankAccountController;

use App\Models\BankAccount;
use App\Models\Branch;
use App\Models\Church;
use App\Models\Project;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class GetMethodsTest extends TestCase
{
    /**
     * @dataProvider urlAndStatusCode
     *
     * @param string $uri
     * @param int $statusCode
     */
    public function testExpectedErrorIfIdNotInformed(string $uri, int $statusCode)
    {
        $response = $this->call('GET', $uri);
        $this->assertEquals($statusCode, $response->status());
        $this->seeJsonStructure($this->getDefaultErrorStructure());
    }

    public function urlAndStatusCode(): array
    {
        return [
            ['api/v1/bank-accounts/', Response::HTTP_UNPROCESSABLE_ENTITY],
            ['api/v1/branches/', Response::HTTP_UNPROCESSABLE_ENTITY],
            ['api/v1/churches/', Response::HTTP_UNPROCESSABLE_ENTITY],
            ['api/v1/projects/', Response::HTTP_UNPROCESSABLE_ENTITY]
        ];
    }

    /**
     * @dataProvider uriAndModelPath
     *
     * @param string $uri
     * @param string $model
     */
    public function testExpectedJsonStructureInTheMethod(string $uri, string $model)
    {
        $id = $model::pluck('id')->random();
        $response = $this->call('GET', $uri . $id);
        $this->assertEquals(Response::HTTP_OK, $response->status());
        $this->seeJsonStructure($this->getDefaultSuccessStructure());
    }

    public function uriAndModelPath(): array
    {
        return [
            ['api/v1/bank-accounts/', BankAccount::class],
            ['api/v1/branches/', Branch::class],
            ['api/v1/churches/', Church::class],
            ['api/v1/projects/', Project::class],
            ['api/v1/users/', User::class],
        ];
    }
}
