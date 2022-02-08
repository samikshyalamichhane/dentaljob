<?php

namespace Modules\EmploymentSalaryType\Repositories;

use App\Repositories\Crud\CrudInterface;

interface EmploymentSalaryTypeInterface extends CrudInterface
{
	public function create($data);
	public function update($data, $id);
}
