<?php

namespace Modules\Page\Repositories;

use App\Repositories\Crud\CrudInterface;

interface PageInterface extends CrudInterface
{
	public function create($data);
	public function update($data, $id);
}
