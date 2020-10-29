<?php

namespace App\Services;

use App\Models\Address;
use App\Models\Church;
use Exception;
use InvalidArgumentException;

class ChurchService extends AbstractService implements ChurchServiceInterface
{
    public function __construct()
    {
        parent::__construct(new Church());
    }

    public function setPrimaryKeys(array $ids): ChurchService
    {
        parent::setPrimaryKeys($ids);
        return $this;
    }

    public function setPrimaryKey(int $id): ChurchService
    {
        parent::setPrimaryKey($id);
        return $this;
    }

    public function get(): Church
    {
        /** @var Church $church */
        $church = parent::get();
        return $church;
    }

    public function store()
    {
        $fill = $this->getFillable();
        if (! array_key_exists('cnpj', $fill)) {
            $message = 'Cnpj must be informed to verify if the church was stored';
            throw new InvalidArgumentException($message, 422);
        }
        $this->isStored('cnpj', $fill['cnpj']);
        if (! array_key_exists('branch_id', $fill)) {
            $message = 'The branch_id field must be informed to verify if the branch exists';
            throw new InvalidArgumentException($message, 422);
        }
        $this->isStored('branch_id', $fill['branch_id']);

        if (! array_key_exists('address_id', $fill)) {
            $message = 'The address_id field must be informed to verify if the address exists';
            throw new InvalidArgumentException($message, 422);
        }
        $errorMessage = 'Address_id is stored another church';
        $this->isStored('address_id', $fill['address_id'], $errorMessage);
        $this->model::create($fill);
    }

    public function update()
    {
        $values = $this->getFillable();
        if (array_key_exists('cnpj', $values)) {
            $this->isStored('cnpj', $values['cnpj']);
        }
        if (array_key_exists('branch_id', $values)) {
            $this->isStored('branch_id', $values['branch_id']);
        }
        if (array_key_exists('address_id', $values)) {
            $this->isStored('address_id', $values['address_id']);
        }
        $this->get()->update($values);
    }

    /**
     * @throws Exception
     */
    public function delete()
    {
        $church = $this->get();
        $address = $church->address();
        $church->delete();
        if ($address instanceof Address) {
            $address->delete();
        }
    }
}
