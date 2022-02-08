<?php

namespace Modules\Advertisement\Repositories;

use Modules\Advertisement\Entities\Advertisement;
use App\Repositories\Crud\CrudRepository;

class AdvertisementRepository extends CrudRepository implements AdvertisementInterface
{
    public function __construct(Advertisement $model)
    {
        $this->model = $model;
    }
    public function create($data)
    {
        $detail = $this->model->create($data);
        return $detail;
    }
    public function update($data, $id)
    {
        return $this->model->find($id)->update($data);
    }
}
