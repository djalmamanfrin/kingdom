<?php

namespace Tests\API;

use App\Models\BankAccount;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class StoreMethodTest extends TestCase
{
    public function testStoreBankAccount()
    {
        $payload = factory(BankAccount::class)->make()->toArray();
        $response = $this->call('POST', self::URI, $payload);
        $this->assertEquals(Response::HTTP_CREATED, $response->status());
        $this->seeJsonStructure([]);
    }

    /**
     * @dataProvider validateMiddlewareRequiredFields
     * @param string                 $field
     * @param string                 $message
     */
    public function testExceptionIfNotFoundRequiredFieldsToStoreANewBankAccount(string $field, string $message) {
        $payload = [];
        $response = $this->call('POST', self::URI, $payload);
        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $response->status());
        $this->seeJsonStructure($this->getDefaultErrorStructure());

        $content = json_decode($response->getContent(), true);
        $errorStructure = $content['errors']['error_text'];
        $this->assertArrayHasKey($field, $errorStructure);
        $this->assertEquals($message, current($errorStructure[$field]));
    }

    public function validateMiddlewareRequiredFields()
    {
        return validate_middleware_fields('required');
    }

    /**
     * @dataProvider validateMiddlewareExistFields
     * @param string                 $field
     * @param string                 $message
     */
    public function testExceptionIfInDatabaseNotExistFieldsToStoreANewBankAccount(string $field, string $message) {
        $payload[$field] = 1000;
        $response = $this->call('POST', self::URI, $payload);
        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $response->status());
        $this->seeJsonStructure($this->getDefaultErrorStructure());

        $content = json_decode($response->getContent(), true);
        $errorStructure = $content['errors']['error_text'];
        $this->assertArrayHasKey($field, $errorStructure);
        $this->assertEquals($message, current($errorStructure[$field]));
    }

    public function validateMiddlewareExistFields()
    {
        return validate_middleware_fields('exists');
    }

    /**
     * @dataProvider validateMiddlewareNumericFields
     * @param string                 $field
     * @param string                 $message
     */
    public function testExceptionIfIsNotNumericFieldsToStoreANewBankAccount(string $field, string $message) {
        $payload = factory(BankAccount::class, 1)->create()->get(0)->toArray();
        $payload[$field] = 'asd';

        $response = $this->call('POST', self::URI, $payload);
        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $response->status());
        $this->seeJsonStructure($this->getDefaultErrorStructure());

        $content = json_decode($response->getContent(), true);
        $errorStructure = $content['errors']['error_text'];
        $this->assertArrayHasKey($field, $errorStructure);
        $this->assertEquals($message, current($errorStructure[$field]));
    }

    public function validateMiddlewareNumericFields()
    {
        return validate_middleware_fields('numeric');
    }

    /**
     * @dataProvider validateMiddlewareStringFields
     * @param string                 $field
     * @param string                 $message
     */
    public function testExceptionIfIsNotStringFieldsToStoreANewBankAccount(string $field, string $message) {
        $payload = factory(BankAccount::class, 1)->create()->get(0)->toArray();
        $payload[$field] = 12;

        $response = $this->call('POST', self::URI, $payload);
        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $response->status());
        $this->seeJsonStructure($this->getDefaultErrorStructure());

        $content = json_decode($response->getContent(), true);
        $errorStructure = $content['errors']['error_text'];
        $this->assertArrayHasKey($field, $errorStructure);
        $this->assertEquals($message, current($errorStructure[$field]));
    }

    public function validateMiddlewareStringFields()
    {
        return validate_middleware_fields('string');
    }

    /**
     * @dataProvider validateMiddlewareUniqueFields
     * @param string                 $field
     * @param string                 $message
     */
    public function testExceptionIfIsNotUniqueFieldsToStoreANewBankAccount(string $field, string $message) {
        $payload = BankAccount::inRandomOrder()->first()->toArray();
        $response = $this->call('POST', self::URI, $payload);
        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $response->status());
        $this->seeJsonStructure($this->getDefaultErrorStructure());

        $content = json_decode($response->getContent(), true);
        $errorStructure = $content['errors']['error_text'];
        $this->assertArrayHasKey($field, $errorStructure);
        $this->assertEquals($message, current($errorStructure[$field]));
    }

    public function validateMiddlewareUniqueFields()
    {
        return validate_middleware_fields('unique');
    }

    /**
     * @dataProvider validateMiddlewareInFields
     * @param string                 $field
     * @param string                 $message
     */
    public function testExceptionIfIsNotInsideRangeFieldsToStoreANewBankAccount(string $field, string $message) {
        $payload = factory(BankAccount::class, 1)->make()->get(0)->toArray();
        $payload[$field] = 3;
        $response = $this->call('POST', self::URI, $payload);
        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $response->status());
        $this->seeJsonStructure($this->getDefaultErrorStructure());

        $content = json_decode($response->getContent(), true);
        $errorStructure = $content['errors']['error_text'];
        $this->assertArrayHasKey($field, $errorStructure);
        $this->assertEquals($message, current($errorStructure[$field]));
    }

    public function validateMiddlewareInFields()
    {
        return validate_middleware_fields('in');
    }
}
