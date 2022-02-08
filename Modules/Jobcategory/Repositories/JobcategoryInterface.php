<?php

namespace Modules\Jobcategory\Repositories;

use App\Repositories\Crud\CrudInterface;

interface JobcategoryInterface extends CrudInterface
{
	public function create($data);
	public function update($data, $id);
}
