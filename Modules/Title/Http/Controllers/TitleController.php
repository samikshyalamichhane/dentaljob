<?php

namespace Modules\Title\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Title\Repositories\TitleRepository;
use Illuminate\Routing\Controller;

class TitleController extends Controller
{

    public function __construct(TitleRepository $model)
    {
        $this->model = $model;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $datas['details'] = $details = $this->model->latest()->get();
        return view('title::index',compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('title::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'title' => 'required',
        ]);

        $formData = $request->except(['publish']);
        $formData['publish'] = is_null($request->publish) ? 0 : 1;
        // dd($formData);
        $this->model->create($formData);
        return redirect()->route('title.index')->with('message', 'Title created successfuly.');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('title::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $datas['detail'] = $detail = $this->model->findOrFail($id);
        return view('title::edit',$datas);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
        ]);
        $oldRecord = $this->model->findOrFail($id);
        $formData = $request->except(['publish']);

        $formData['publish'] = is_null($request->publish) ? 0 : 1;

        $this->model->update($formData, $id);

        return redirect()->route('title.index')->with('message', 'title edited successfuly.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $oldRecord = $this->model->findOrFail($id);

        $oldRecord->delete();
        return redirect()->route('title.index')->with('message', 'title deleted successfuly.');
    }
}
