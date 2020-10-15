<?php

namespace Tests\Services;

use App\Models\Bank;
use App\Models\BankAccount;
use App\Models\User;
use App\Services\BankAccountService;
use App\Services\BankAccountServiceInterface;
use Exception;
use InvalidArgumentException;
use Tests\TestCase;

class BankAccountServiceTest extends TestCase
{
    /**
     * @dataProvider service
     * @param BankAccountServiceInterface $bankAccount
     */
    public function testExceptionIfPrimaryKeyIsEmptyWhenGetMethodIsInvoked(BankAccountServiceInterface $bankAccount)
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(422);
        $this->expectExceptionMessage('You must inform at least one primary key');
        $bankAccount->get();
    }

    /**
     * @dataProvider service
     * @param BankAccountServiceInterface $bankAccount
     */
    public function testIfTheMethodReturnRelationships(BankAccountServiceInterface $bankAccount)
    {
        $id = BankAccount::pluck('id')->random();
        $bankAccountModel = $bankAccount->setPrimaryKey($id)->get();
        $this->assertInstanceOf(BankAccount::class, $bankAccountModel);
        $this->assertInstanceOf(User::class, $bankAccountModel->user());
        $this->assertInstanceOf(Bank::class, $bankAccountModel->bank());
    }

    /**
     * @dataProvider service
     * @param BankAccountServiceInterface $bankAccount
     */
    public function testExceptionIfBankAccountIdNotFound(BankAccountServiceInterface $bankAccount)
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(422);
        $this->expectExceptionMessage('The bank account not found');
        $bankAccount->setPrimaryKey(1000)->get();
    }

    /**
     * @dataProvider service
     * @param BankAccountServiceInterface $bankAccount
     * @throws Exception
     */
    public function testDeleteAction(BankAccountServiceInterface $bankAccount) {
        $id = BankAccount::pluck('id')->random();
        $bankAccount->setPrimaryKey($id)->delete();
        $this->expectNotToPerformAssertions();
    }

    public function service(): array
    {
        return [
            [app(BankAccountService::class)]
        ];
    }
}
