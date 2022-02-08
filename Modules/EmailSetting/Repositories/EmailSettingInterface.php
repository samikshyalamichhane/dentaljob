<?php

namespace Modules\EmailSetting\Repositories;

use App\Repositories\Crud\CrudInterface;

interface EmailSettingInterface extends CrudInterface
{
	public function create($data);
	public function update($data, $id);
}
