<?php

namespace Modules\Advertisement\Repositories;

use App\Repositories\Crud\CrudInterface;

interface AdvertisementInterface extends CrudInterface
{
    public function create($data);
    public function update($data, $id);
}
