<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request){

       
        $users = User::with('departments', 'designations');

        if ($request->input) {

            $search = '%' . $request->input . '%';

            $users = $users->where(function ($query) use ($search) {
                $query->where('name', 'like', $search)
                    ->orWhereHas('departments', function ($q) use ($search) {
                        $q->where('name', 'like', $search);
                    })
                    ->orWhereHas('designations', function ($q) use ($search) {
                        $q->where('name', 'like', $search);
                    });
            });

           
        }
    
        $users = $users->get();

        if ($request->ajax()) {
            return response()->json($users);
        }
  
        return view('index',['users' => $users]);

    }
}
