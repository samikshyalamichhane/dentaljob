<?php

namespace Modules\Setting\Repositories;

use Modules\Setting\Entities\Setting;
use App\Repositories\Crud\CrudRepository;

class SettingRepository extends CrudRepository implements SettingInterface
{
	public function __construct(Setting $model)
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
