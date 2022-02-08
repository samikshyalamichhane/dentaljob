<?php

namespace Modules\Employer\Repositories;

use App\Repositories\Crud\CrudInterface;

interface EmployerInterface extends CrudInterface
{
	public function create($data);
	public function update($data, $id);
}
