<?php

namespace Tests\API;

use App\Models\BankAccount;
use App\Models\Branch;
use App\Models\Church;
use App\Models\Project;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class DeleteMethodsTest extends TestCase
{
    /**
     * @dataProvider urlAndStatusCode
     *
     * @param string $uri
     * @param int $statusCode
     */
    public function testExpectedErrorIfIdNotInformed(string $uri, int $statusCode)
    {
        $response = $this->call('DELETE', $uri);
        $this->assertEquals($statusCode, $response->status());
        $this->seeJsonStructure($this->getDefaultErrorStructure());
    }

    public function urlAndStatusCode(): array
    {
        return [
            ['api/v1/bank-accounts/', Response::HTTP_BAD_REQUEST],
            ['api/v1/branches/', Response::HTTP_BAD_REQUEST],
            ['api/v1/churches/', Response::HTTP_BAD_REQUEST],
            ['api/v1/projects/', Response::HTTP_BAD_REQUEST],
            ['api/v1/users/', Response::HTTP_BAD_REQUEST]
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
        $response = $this->call('DELETE', $uri . $id);
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
            ['api/v1/users/', User::class],
        ];
    }
}
