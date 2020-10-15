<?php

namespace Tests\Services;

use App\Models\Branch;
use App\Models\Church;
use App\Models\Project;
use App\Models\User;
use App\Services\BranchService;
use App\Services\BranchServiceInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use InvalidArgumentException;
use Tests\TestCase;

class BranchServiceTest extends TestCase
{
    /**
     * @dataProvider obligatedFieldsToStoreANewBranch
     * @param BranchServiceInterface $branch
     * @param string                 $field
     */
    public function testExceptionIfObligatedFieldsNotInformedToStoreANewBranch(
        BranchServiceInterface $branch,
        string $field
    ) {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(422);

        $id = Branch::pluck('id')->random();
        $fillable = $branch->setPrimaryKey($id)->get()->toArray();
        unset($fillable[$field]);
        $branch->setFillable($fillable);
        $branch->store();
    }

    public function obligatedFieldsToStoreANewBranch()
    {
        $service = app(BranchService::class);
        return [
            [$service, 'name'],
            [$service, 'user_id'],
            [$service, 'email']
        ];
    }

    /**
     * @dataProvider service
     * @param BranchServiceInterface $branch
     */
    public function testExceptionIfObligatedFieldsHasInformedButNotFoundToStoreANewBranch(BranchServiceInterface $branch) {
        $this->expectException(ModelNotFoundException::class);

        $id = Branch::pluck('id')->random();
        $fillable = $branch->setPrimaryKey($id)->get()->toArray();
        $fillable['user_id'] = 1000;
        $branch->setFillable($fillable);
        $branch->store();
    }

    /**
     * @dataProvider service
     * @param BranchServiceInterface $branch
     */
    public function testExceptionIfObligatedFieldsHasInformedButNotFoundToUpdateABranch(BranchServiceInterface $branch) {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(422);

        $id = Branch::pluck('id')->random();
        $fillable = $branch->setPrimaryKey($id)->get()->toArray();
        $fillable['user_id'] = 1000;
        $branch->setFillable($fillable);
        $branch->update();
    }

    /**
     * @dataProvider service
     * @param BranchServiceInterface $branch
     */
    public function testExceptionIfPrimaryKeyIsEmptyWhenGetMethodIsInvoked(BranchServiceInterface $branch)
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(422);
        $this->expectExceptionMessage('You must inform at least one primary key');
        $branch->get();
    }

    /**
     * @dataProvider service
     * @param BranchServiceInterface $branch
     */
    public function testIfMethodsReturnIsAnCollectionInstance(BranchServiceInterface $branch)
    {
        $id = Branch::pluck('id')->random();
        $branchModel = $branch->setPrimaryKey($id)->get();
        $this->assertInstanceOf(Collection::class, $branchModel->churches()->get());
        $this->assertInstanceOf(Collection::class, $branchModel->projects()->get());
        $this->assertInstanceOf(Collection::class, $branch->get()->user()->bankAccounts()->get());
    }

    /**
     * @dataProvider service
     * @param BranchServiceInterface $branch
     */
    public function testExceptionIfBranchIdNotFound(BranchServiceInterface $branch)
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(422);
        $this->expectExceptionMessage('The branch not found');
        $branch->setPrimaryKey(1000)->get();
    }

    /**
     * @dataProvider service
     * @param BranchServiceInterface $branch
     */
    public function testIfTheMethodReturnIsAnBranchInstance(BranchServiceInterface $branch)
    {
        $id = Branch::pluck('id')->random();
        $branchModel = $branch->setPrimaryKey($id)->get();
        $this->assertInstanceOf(Branch::class, $branchModel);
    }

    /**
     * @dataProvider service
     * @param BranchServiceInterface $branch
     *
     * @throws Exception
     */
    public function testDeleteBranchWithRelationship(BranchServiceInterface $branch) {
        $church = factory(Church::class, 1)->make()->get(0);
        $branch->setPrimaryKey($church->branch_id)->delete();
        $project = factory(Project::class, 1)->make()->get(0);
        $branch->setPrimaryKey($project->branch_id)->delete();
        $this->expectNotToPerformAssertions();
    }

    /**
     * @dataProvider service
     * @param BranchServiceInterface $branch
     */
    public function testIfTheMethodReturnIsAnBankAccountInstance(BranchServiceInterface $branch)
    {
        $id = Branch::pluck('id')->random();
        $branch->setPrimaryKey($id)->get()->toArray();
        $userModel = $branch->get()->user();
        $this->assertInstanceOf(User::class, $userModel);
    }

    public function service(): array
    {
        return [
            [app(BranchService::class)]
        ];
    }
}
