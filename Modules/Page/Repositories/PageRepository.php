<?php

namespace Modules\Page\Repositories;

use Modules\Page\Entities\Page;
use App\Repositories\Crud\CrudRepository;

class PageRepository extends CrudRepository implements PageInterface
{
	public function __construct(Page $model)
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
