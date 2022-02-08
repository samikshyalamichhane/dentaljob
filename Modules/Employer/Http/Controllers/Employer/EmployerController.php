<?php

namespace Modules\Employer\Http\Controllers\Employer;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Employer\Repositories\EmployerRepository;

class EmployerController extends Controller
{
   protected $model = null;
   public function __construct(EmployerRepository $model)
   {
      $this->model = $model;
   }

   public function getEmployerDashboard()
   {
      return view('employer::employer.dashboard');
   }

   public function create()
   {
      return abort(404);
   }

   /**
    * Show the form for editing the specified resource.
    * @param int $id
    * @return Renderable
    */
   public function edit($id)
   {
      $datas['detail'] = $detail = $this->model->findOrFail($id);
      return view('employer::employer.edit', $datas);
   }

   /**
    * Update the specified resource in storage.
    * @param Request $request
    * @param int $id
    * @return Renderable
    */
   public function update(Request $request, $id)
   {
      $oldRecord = $this->model->findOrFail($id);

      $formData = $this->model->employerUpdate($request, $oldRecord);

      $this->model->update($formData, $id);

      return redirect()->back()->with('message', 'Employer detail updated successfully');
   }
}
