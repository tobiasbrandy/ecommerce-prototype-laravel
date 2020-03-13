<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Category;
use App\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $categories = Category::where('category_id', null)->get();

      $products = Product::where('stock', '>', 0)->inRandomOrder()->limit(8)->get();

        return view('home', [
          'categories' => $categories,
          'products' => $products
        ]);
    }

    public function searchGet($idCategory, $age, $price = ''){
        $fatherCategory = Category::findOrFail($idCategory);
        $childrenCategories = $fatherCategory->childrenCategories;
        $arrayChildrenCategories = [];
        foreach ($childrenCategories as $category) {
          $arrayChildrenCategories[] = $category->id;
        }

        //Product::where('price', '<=', $price)->get() PRECIO
        //Product::where('ageMin', '<=', $age)->where('ageMax', '>=', $age)->get() EDAD
        //Product::whereIn('category_id', $arrayChildrenCategories)->get() CATEGORIAS

        $products = Product::whereIn('category_id', $arrayChildrenCategories)
          ->when(!($price == ''), function ($query) use ($price) {                 //The where excecutes only when the first paramenter of the when is true.
            return $query->where('price', '<=', $price);
          })
          ->when(!($age == -1), function ($query) use ($age) {
            return $query->where('ageMin', '<=', $age)->where('ageMax', '>=', $age);
          })
          ->get();


        return view('/searchResult', [
          'products' => $products,
          'subCategories' => $childrenCategories,
          'age' => $age,
          'price' => $price,
          'idCategory' => $idCategory,
        ]);
    }

    public function searchPost(Request $request){
      $age = $request->input('age');
      $price = $request->input('price');
      $idCategory = $request->input('category');
      $fatherCategory = Category::findOrFail($idCategory);
      $childrenCategories = $fatherCategory->childrenCategories;
      $arrayChildrenCategories = [];
      foreach ($childrenCategories as $category) {
        $arrayChildrenCategories[] = $category->id;
      }
      //Product::where('price', '<=', $price)->get() PRECIO
      //Product::where('ageMin', '<=', $age)->where('ageMax', '>=', $age)->get() EDAD
      //Product::whereIn('category_id', $arrayChildrenCategories)->get() CATEGORIAS

      $products = Product::whereIn('category_id', $arrayChildrenCategories)
        ->when(!($price == ''), function ($query) use ($price) {                 //The where excecutes only when the first parameter of the when is true.
          return $query->where('price', '<=', $price);
        })
        ->when(!($age == -1), function ($query) use ($age) {
          return $query->where('ageMin', '<=', $age)->where('ageMax', '>=', $age);
        })
        ->get();

      return view('/searchResult', [
        'products' => $products,
        'subCategories' => $childrenCategories,
        'age' => $age,
        'price' => $price,
        'idCategory' => $idCategory,
      ]);
    }

      public function subSearch($idSubCategory, $idCategory, $age, $price = ''){

        $fatherCategory = Category::findOrFail($idCategory);
        $childrenCategories = $fatherCategory->childrenCategories;

        $arrayChildrenCategories = [];
        foreach ($childrenCategories as $category) {
          $arrayChildrenCategories[] = $category->id;
      }

      $products = Product::whereIn('category_id', $arrayChildrenCategories)
        ->when(!($price == ''), function ($query) use ($price) {                 //The where excecutes only when the first paramenter of the when is true.
          return $query->where('price', '<=', $price);
        })
        ->when(!($age == -1), function ($query) use ($age) {
          return $query->where('ageMin', '<=', $age)->where('ageMax', '>=', $age);
        })
        ->where('category_id', $idSubCategory)
        ->get();

        return view('/searchResult', [
          'products' => $products,
          'subCategories' => $childrenCategories,
          'age' => $age,
          'price' => $price,
          'idCategory' => $idCategory,
        ]);

    }
}
