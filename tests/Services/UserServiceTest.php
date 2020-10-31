<?php

namespace Tests\Services;

use App\Models\Profile;
use App\Models\User;
use App\Services\UserService;
use App\Services\UserServiceInterface;
use Illuminate\Support\Collection;
use InvalidArgumentException;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    /**
     * @dataProvider service
     * @param UserServiceInterface $user
     */
    public function testExceptionIfEmailIsNotInformedToStoreANewUser(UserServiceInterface $user)
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(422);
        $this->expectExceptionMessage('Email must be inform to verify if the user was stored');

        $fillable = factory(User::class, 1)->create()->get(0)->toArray();
        unset($fillable['email']);
        $user->setFillable($fillable);
        $user->store();
    }

    /**
     * @dataProvider service
     * @param UserServiceInterface $user
     */
    public function testExceptionIfUserHasAlreadyExistInTheStoreMethod(UserServiceInterface $user)
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(422);
        $this->expectExceptionMessage('Email already stored');

        $id = User::pluck('id')->random();
        $userModel = $user->setPrimaryKey($id)->get();
        $fillable['email'] = $userModel->email;
        $user->setFillable($fillable);
        $user->store();
    }

    /**
     * @dataProvider service
     * @param UserServiceInterface $user
     */
    public function testExceptionIfTheEmailHasExistInTheUpdateMethod(UserServiceInterface $user)
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(422);
        $this->expectExceptionMessage('Email already stored');

        $id = User::pluck('id')->random();
        $userModel = $user->setPrimaryKey($id)->get();
        $fillable['email'] = $userModel->email;
        $user->setFillable($fillable);
        $user->update();
    }

    /**
     * @dataProvider service
     * @param UserServiceInterface $user
     */
    public function testExceptionIfPrimaryKeyIsEmptyWhenGetMethodIsInvoked(UserServiceInterface $user)
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(422);
        $this->expectExceptionMessage('You must inform at least one primary key');
        $user->get();
    }

    /**
     * @dataProvider service
     * @param UserServiceInterface $user
     */
    public function testIfMethodsReturnIsAnCollectionInstance(UserServiceInterface $user)
    {
        $id = User::pluck('id')->random();
        $userModel = $user->setPrimaryKey($id)->get();
        $this->assertInstanceOf(Collection::class, $userModel->branches()->get());
        $this->assertInstanceOf(Collection::class, $userModel->bankCards()->get());
        $this->assertInstanceOf(Collection::class, $userModel->bankAccounts()->get());
        $this->assertInstanceOf(Collection::class, $userModel->addresses()->get());
        $this->assertInstanceOf(Collection::class, $userModel->indications()->get());
        $this->assertInstanceOf(Collection::class, $userModel->notifications()->get());
    }

    /**
     * @dataProvider service
     * @param UserServiceInterface $user
     */
    public function testIfTheMethodReturnIsAnUserInstance(UserServiceInterface $user)
    {
        $id = User::pluck('id')->random();
        $userModel = $user->setPrimaryKey($id)->get();
        $this->assertInstanceOf(User::class, $userModel);
    }

    /**
     * @dataProvider service
     * @param UserServiceInterface $user
     */
    public function testIfTheMethodReturnIsAnProfileInstance(UserServiceInterface $user)
    {
        $id = User::pluck('id')->random();
        $profileModel = $user->setPrimaryKey($id)->get()->profile();
        $this->assertInstanceOf(Profile::class, $profileModel);
    }

    public function service(): array
    {
        return [
            [app(UserService::class)]
        ];
    }
}
