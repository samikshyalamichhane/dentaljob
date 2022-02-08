<?php

namespace Modules\EmailSetting\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\EmailSetting\Repositories\EmailSettingRepository;
use Illuminate\Routing\Controller;

class EmailSettingController extends Controller
{

    public function __construct(EmailSettingRepository $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        // return view('emailsetting::index');
        $datas['detail'] = $detail = $this->model->first();
        return view('emailsetting::index', $datas);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        abort('404');
        return view('emailsetting::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        abort('404');

        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        abort('404');

        return view('emailsetting::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        abort('404');
        return view('emailsetting::edit');
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

        $formData = $request->except(['publish']);
        // dd($request->all());
        $formData['publish'] = is_null($request->publish) ? 0 : 1;
        $oldRecord->update($formData);
        return redirect()->route('emailsetting.index')->with('message', 'Message updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
