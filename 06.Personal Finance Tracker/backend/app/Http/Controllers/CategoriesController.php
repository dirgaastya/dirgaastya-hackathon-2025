<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function getAllCategories(){
        $categories = Category::select('id','name','description')->get();
        return response()->json([
            'status' => true,
            'data'=> $categories,
            'message' => 'Successfully Obtained Category Data'
        ]);
    }
}
