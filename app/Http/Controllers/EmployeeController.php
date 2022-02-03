<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct(Employee $model)
    {
        $this->model = $model;
    }

    public function index(Request $request)
    {

        $sortField     =  $request->sortBy;;
		$length         = $request->length;
        $searchValue    = $request->search;

        $index = $this->model->orderBy('created_at', 'desc');

        if ($sortField) {
            $index = $this->model->orderBy($sortField, 'asc');
        }

        $this->search($index, $searchValue);
        
        $index = $index->paginate($length);

    	return ['data'=>$index, 'draw'=> $request->draw];
    }

    public function search($collection, $searchValue) {
        if ($searchValue) {
            return $collection->where(function($query) use($searchValue){
                $query
                ->where('cats_number','LIKE','%'.$searchValue.'%')
                ->orWhere('first_name','LIKE','%'.$searchValue.'%')
                ->orWhere('last_name','LIKE','%'.$searchValue.'%');
            });
        }
    }

    public function store(Request $request) {
       

        return $this->model->create($request->all());
    }

    public function edit(Request $request) {
        return $this->model->findOrFail($request->id);
    }

    public function update(Request $request) {
        $data = $this->model->findOrFail($request->id);
        $data->update($request->all());

        return "Success!";
    }

    public function delete(Request $request) {
        $data = $this->model->findOrFail($request->id);
        $data->delete();
        return "Deleted!";

    }
}
