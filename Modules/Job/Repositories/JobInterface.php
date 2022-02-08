<?php

namespace Modules\Job\Repositories;

use App\Repositories\Crud\CrudInterface;

interface JobInterface extends CrudInterface
{
	public function create($data);
	public function update($data, $id);
}
