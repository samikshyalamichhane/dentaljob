<?php

namespace Modules\Setting\Repositories;

use App\Repositories\Crud\CrudInterface;

interface SettingInterface extends CrudInterface
{
	public function create($data);
	public function update($data, $id);
}
