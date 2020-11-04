<?php

namespace App\Services;

use App\Models\Member;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use \Illuminate\Support\Collection;
use InvalidArgumentException;

class UserService extends AbstractService implements UserServiceInterface
{
    private ProfileServiceInterface $profile;

    public function __construct(ProfileServiceInterface $profile) {
        parent::__construct(new User());
        $this->profile = $profile;
    }

    public function setPrimaryKeys(array $ids): UserService
    {
        parent::setPrimaryKeys($ids);
        return $this;
    }

    public function setPrimaryKey(int $id): UserService
    {
        parent::setPrimaryKey($id);
        return $this;
    }

    public function get(): User
    {
        /** @var User $user */
        $user = parent::get();
        $user->profile =  $user->profile()->name;
        return $user;
    }

    public function all(): LengthAwarePaginator
    {
       $query = $this->model->newQuery()
            ->select(['user.*', 'profile.id AS profile_id', 'profile.name AS type'])
            ->join('profile', 'user.profile_id', '=', 'profile.id');
        if (! empty($this->primaryKeys)) {
            $query->whereIn('user.id', $this->primaryKeys);
        }
        return $query->paginate(15);
    }

    public function store()
    {
        $fill = $this->getFillable();
        $this->isStored('email', $fill['email']);
        $this->model::create($fill);
    }

    public function update()
    {
        $values = $this->getFillable();
        if (array_key_exists('email', $values)) {
            $this->isStored('email', $values['email']);
        }
        $this->get()->update($values);
    }
}
