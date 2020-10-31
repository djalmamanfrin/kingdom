<?php

namespace App\Services;

use App\Models\Branch;
use App\Models\Product;
use App\Models\Project;
use App\Models\ProjectType;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class ProjectService extends AbstractService implements ProjectServiceInterface
{
    public function __construct()
    {
        parent::__construct(new Project());
    }

    public function setPrimaryKeys(array $ids): ProjectService
    {
        parent::setPrimaryKeys($ids);
        return $this;
    }

    public function setPrimaryKey(int $id): ProjectService
    {
        parent::setPrimaryKey($id);
        return $this;
    }

    public function get(): Project
    {
        /** @var Project $project */
        $project = parent::get();
        return $project;
    }

    public function store()
    {
        $fill = $this->getFillable();
        Branch::query()->findOrFail($fill['branch_id']);
        ProjectType::query()->findOrFail($fill['project_type_id']);
        $this->model::create($fill);
    }

    public function update()
    {
        $fill = $this->getFillable();
        if (array_key_exists('branch_id', $fill)) {
            Branch::query()->findOrFail($fill['branch_id']);
        }
        if (array_key_exists('project_type_id', $fill)) {
            ProjectType::query()->findOrFail($fill['project_type_id']);
        }
        $this->get()->update($fill);
    }

    /**
     * @throws Exception
     */
    public function delete()
    {
        try {
            DB::beginTransaction();
            $this->get()->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new InvalidArgumentException('Error to delete project: ' . $e->getMessage(), 422);
        }
    }

    public function products(): Collection
    {
        $items = $this->get()->items();
        return $items->map(function ($item) {
            return $item->product()->projectView();
        });
    }
}
