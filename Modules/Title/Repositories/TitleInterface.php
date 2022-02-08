<?php

namespace Modules\Title\Repositories;

use App\Repositories\Crud\CrudInterface;

interface TitleInterface extends CrudInterface
{
	public function create($data);
	public function update($data, $id);
}
