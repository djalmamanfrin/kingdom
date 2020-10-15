<?php

namespace Tests\Services;

use App\Models\Address;
use App\Models\Branch;
use App\Models\Church;
use App\Services\ChurchService;
use App\Services\ChurchServiceInterface;
use Exception;
use InvalidArgumentException;
use Tests\TestCase;

class ChurchServiceTest extends TestCase
{
    /**
     * @dataProvider service
     * @param ChurchServiceInterface $church
     */
    public function testExceptionIfCnpjIsNotInformedToStoreANewChurch(ChurchServiceInterface $church)
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(422);
        $this->expectExceptionMessage('Cnpj must be informed to verify if the church was stored');

        $fillable = factory(Church::class, 1)->create()->get(0)->toArray();
        unset($fillable['cnpj']);
        $church->setFillable($fillable);
        $church->store();
    }

    /**
     * @dataProvider service
     * @param ChurchServiceInterface $church
     */
    public function testExceptionIfChurchHasAlreadyExistInTheStoreMethod(ChurchServiceInterface $church)
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(422);
        $this->expectExceptionMessage('Cnpj already stored');

        $churchModel = $church->setPrimaryKey(1)->get();
        $fillable['cnpj'] = $churchModel->cnpj;
        $church->setFillable($fillable);
        $church->store();
    }

    /**
     * @dataProvider service
     * @param ChurchServiceInterface $church
     */
    public function testExceptionIfTheCnpjHasExistInTheUpdateMethod(ChurchServiceInterface $church)
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(422);
        $this->expectExceptionMessage('Cnpj already stored');

        $churchModel = $church->setPrimaryKey(1)->get();
        $fillable['cnpj'] = $churchModel->cnpj;
        $church->setFillable($fillable);
        $church->update();
    }

    /**
     * @dataProvider service
     * @param ChurchServiceInterface $church
     */
    public function testExceptionIfPrimaryKeyIsEmptyWhenGetMethodIsInvoked(ChurchServiceInterface $church)
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(422);
        $this->expectExceptionMessage('You must inform at least one primary key');
        $church->get();
    }

    /**
     * @dataProvider service
     * @param ChurchServiceInterface $church
     */
    public function testRelationships(ChurchServiceInterface $church)
    {
        $id = Church::pluck('id')->random();
        $church->setPrimaryKey($id);
        $addressModel = $church->get()->address();
        $this->assertInstanceOf(Address::class, $addressModel);
        $branchModel = $church->get()->branch();
        $this->assertInstanceOf(Branch::class, $branchModel);
    }

    /**
     * @dataProvider service
     * @param ChurchServiceInterface $church
     */
    public function testExceptionIfChurchIdNotFound(ChurchServiceInterface $church)
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(422);
        $this->expectExceptionMessage('The church not found');
        $church->setPrimaryKey(1000)->get();
    }

    /**
     * @dataProvider service
     * @param ChurchServiceInterface $church
     */
    public function testIfTheMethodReturnIsAnChurchInstance(ChurchServiceInterface $church)
    {
        $churchModel = $church->setPrimaryKey(1)->get();
        $this->assertInstanceOf(Church::class, $churchModel);
    }

    /**
     * @dataProvider service
     * @param ChurchServiceInterface $church
     * @throws Exception
     */
    public function testExceptionIfHaveOneOrMoreRelationshipInDeleteAction(ChurchServiceInterface $church) {
        $id = Church::pluck('id')->random();
        $church->setPrimaryKey($id)->delete();
        $this->expectNotToPerformAssertions();
    }

    public function service(): array
    {
        return [
            [app(ChurchService::class)]
        ];
    }
}
