<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function __construct(User $model)
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
                $query->orWhere('name','LIKE','%'.$searchValue.'%');
            });
        }
    }

    public function store_users(Request $request) {
        return $this->model->create($request->all());
    }

    public function edit_user(Request $request) {
        return $this->model->findOrFail($request->id);
    }

    public function update_users(Request $request) {
        $data = $this->model->findOrFail($request->id);
        $data->update($request->all());

        return "Success!";
    }
    
    public function get_current_user() {
        return auth()->user();
    }

    public function delete_user(Request $request) {
        $data = $this->model->findOrFail($request->id);
        $data->delete();

        return "Deleted!";

    }
    
}
