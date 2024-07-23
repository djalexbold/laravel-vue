<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Models\Device;
use Illuminate\Validation\ValidationException;

class DeviceController extends Controller
{
    protected Repository $model;
    public function __construct(Device $device)
    {
        // set the model
        $this->model = new Repository($device);
    }
    public function index()
    {
        return $this->model->all();
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'title' => 'required|max:500'
        ]);

        // create record and pass in only fields that are fillable
        return $this->model->create($request->only($this->model->getModel()->fillable));
    }

    public function show($id)
    {
        return $this->model->show($id);
    }

    public function update(Request $request, $id)
    {
        // update model and only pass in the fillable fields
        $this->model->update($request->only($this->model->getModel()->fillable), $id);

        return $this->model->find($id);
    }

    public function destroy($id)
    {
        return $this->model->delete($id);
    }

}
