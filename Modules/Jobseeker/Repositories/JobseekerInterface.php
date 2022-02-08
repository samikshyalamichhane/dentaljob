<?php

namespace Modules\Jobseeker\Repositories;

use App\Repositories\Crud\CrudInterface;

interface JobseekerInterface extends CrudInterface
{
	public function create($data);
	public function updateJobSeekerProfile($data, $id);
}
