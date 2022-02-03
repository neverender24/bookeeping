<?php

namespace App\Http\Controllers;

use App\Models\Jevh;
use Illuminate\Http\Request;

class JevhController extends Controller
{
    public function __construct(Jevh $model)
    {
        $this->model = $model;
    }
    public function index(Request $request)
    {

        $sortField     =  $request->sortBy;
		$length         = $request->length;
        $searchValue    = $request->search;

        $index = $this->model->orderBy('recid', 'desc');
    
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
}
