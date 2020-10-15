<?php

namespace App\Services;

use App\Models\Profile;
use InvalidArgumentException;

class ProfileService extends AbstractService implements ProfileServiceInterface
{
    public function __construct()
    {
        parent::__construct(new Profile());
    }

    public function setPrimaryKeys(array $ids): ProfileService
    {
        parent::setPrimaryKeys($ids);
        return $this;
    }

    public function setPrimaryKey(int $id): ProfileService
    {
        parent::setPrimaryKey($id);
        return $this;
    }

    public function get(): Profile
    {
        /** @var Profile $branch */
        $branch = parent::get();
        return $branch;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function isResponsible()
    {
        $this->isPrimaryKeyEmpty();
        $profile = $this->get()->toArray();
        if ($profile['id'] !== Profile::RESPONSIBLE) {
            throw new InvalidArgumentException('Responsible profile required to answer this information');
        }
    }
}
