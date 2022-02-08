<?php

namespace Modules\EmailSetting\Repositories;

use Modules\EmailSetting\Entities\EmailSetting;
use App\Repositories\Crud\CrudRepository;

class EmailSettingRepository extends CrudRepository implements EmailSettingInterface
{
	public function __construct(EmailSetting $model)
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
