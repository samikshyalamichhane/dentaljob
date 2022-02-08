<?php

namespace Modules\EmploymentSalaryType\Repositories;

use Modules\EmploymentSalaryType\Entities\EmploymentSalaryType;
use App\Repositories\Crud\CrudRepository;

class EmploymentSalaryTypeRepository extends CrudRepository implements EmploymentSalaryTypeInterface
{
	public function __construct(EmploymentSalaryType $model)
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

	public function rules()
	{
		return [
			'title' => 'required',
			'type' => 'required',
		];
	}
}
