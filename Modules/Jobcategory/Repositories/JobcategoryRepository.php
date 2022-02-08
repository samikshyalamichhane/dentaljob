<?php

namespace Modules\Jobcategory\Repositories;

use Modules\Jobcategory\Entities\Jobcategory;
use App\Repositories\Crud\CrudRepository;

class JobcategoryRepository extends CrudRepository implements JobcategoryInterface
{
	public function __construct(Jobcategory $model)
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
