<?php

namespace Modules\Title\Repositories;

use Modules\Title\Entities\Title;
use App\Repositories\Crud\CrudRepository;

class TitleRepository extends CrudRepository implements TitleInterface
{
	public function __construct(Title $model)
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
