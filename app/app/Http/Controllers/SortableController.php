<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sortable;

class SortableController extends Controller
{
    public function index(){
      $sortable = Sortable::orderBy('id', 'asc')->get();

      return view('sortable', [
        'sortables' => $sortable
      ]);
    }

    public function register(Request $request){
      $sortable = new Sortable;
      $sortable->name = $request->inputName;
      $sortable->save();

      return redirect('/');
    }
}