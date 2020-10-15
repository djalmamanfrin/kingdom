<?php

namespace Tests\Services;

use App\Models\Branch;
use App\Models\Project;
use App\Models\ProjectType;
use App\Services\ProjectService;
use App\Services\ProjectServiceInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use InvalidArgumentException;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class ProjectServiceTest extends TestCase
{
    /**
     * @dataProvider obligatedFieldsNotInformed
     * @param ProjectServiceInterface $project
     * @param string                 $field
     */
    public function testExceptionIfObligatedFieldsNotInformedToStoreANewProject(
        ProjectServiceInterface $project,
        string $field
    ) {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(422);

        $id = Project::pluck('id')->random();
        $fillable = $project->setPrimaryKey($id)->get()->toArray();
        unset($fillable[$field]);
        $project->setFillable($fillable);
        $project->store();
    }

    public function obligatedFieldsNotInformed()
    {
        $service = app(ProjectService::class);
        return [
            [$service, 'title'],
            [$service, 'branch_id'],
            [$service, 'project_type_id']
        ];
    }

    /**
     * @dataProvider obligatedFieldsHasInformedButNotFound
     * @param ProjectServiceInterface $project
     * @param string                  $field
     */
    public function testExceptionIfObligatedFieldsHasInformedButNotFoundToStoreANewProject(
        ProjectServiceInterface $project,
        string $field
    ) {
        $this->expectException(ModelNotFoundException::class);

        $id = Branch::pluck('id')->random();
        $fillable = $project->setPrimaryKey($id)->get()->toArray();
        $fillable[$field] = 1000;
        $project->setFillable($fillable);
        $project->store();
    }

    /**
     * @dataProvider obligatedFieldsHasInformedButNotFound
     * @param ProjectServiceInterface $project
     * @param string                  $field
     */
    public function testExceptionIfObligatedFieldsHasInformedButNotFoundToUpdateAProject(
        ProjectServiceInterface $project,
        string $field
    ) {
        $this->expectException(ModelNotFoundException::class);

        $id = Project::pluck('id')->random();
        $fillable = $project->setPrimaryKey($id)->get()->toArray();
        $fillable[$field] = 1000;
        $project->setFillable($fillable);
        $project->update();
    }

    public function obligatedFieldsHasInformedButNotFound()
    {
        $service = app(ProjectService::class);
        return [
            [$service, 'branch_id'],
            [$service, 'project_type_id']
        ];
    }

    /**
     * @dataProvider service
     * @param ProjectServiceInterface $project
     */
    public function testExceptionIfPrimaryKeyIsEmptyWhenGetMethodIsInvoked(ProjectServiceInterface $project)
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(422);
        $this->expectExceptionMessage('You must inform at least one primary key');
        $project->get();
    }

    /**
     * @dataProvider service
     * @param ProjectServiceInterface $project
     */
    public function testIfTheMethodReturnRelationships(ProjectServiceInterface $project)
    {
        $id = Project::pluck('id')->random();
        $projectModel = $project->setPrimaryKey($id)->get();
        $this->assertInstanceOf(Project::class, $projectModel);
        $this->assertInstanceOf(ProjectType::class, $projectModel->projectType());
        $this->assertInstanceOf(Branch::class, $projectModel->branch());
        $this->assertInstanceOf(Collection::class, $projectModel->items()->get());
    }

    /**
     * @dataProvider service
     * @param ProjectServiceInterface $project
     */
    public function testExceptionIfProjectIdNotFound(ProjectServiceInterface $project)
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(422);
        $this->expectExceptionMessage('The project not found');
        $project->setPrimaryKey(1000)->get();
    }

    /**
     * @dataProvider service
     * @param ProjectServiceInterface $project
     * @throws Exception
     */
    public function testDeleteAction(ProjectServiceInterface $project) {
        $id = Project::pluck('id')->random();
        $project->setPrimaryKey($id)->delete();
        $this->expectNotToPerformAssertions();
    }

    public function service(): array
    {
        return [
            [app(ProjectService::class)]
        ];
    }
}
