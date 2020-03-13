<?php

namespace App\Http\Controllers;

use App\User;

use App\Product;

use App\Category;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;

use Validator;

use Hash;

class ProductController extends Controller
{
    public function create(Request $request){

      $validator = Validator::make($request->all(), [
          'title' => 'required|string|max:50',
          'price' => 'required|integer',
          'ageMin' => 'required|integer|max:' . $request->input('ageMax'),
          'ageMax' => 'required|integer|min:' . $request->input('ageMin'),
          'stock' => 'required|integer',
          'productAvatar' => 'required|max:99999999|image',
          'description' => 'required|max:300',
          'condition' => 'required',
          'subCategory' => 'required',
      ]);

      if ($validator->fails()) {
        return redirect('/registerProduct/')
                ->withErrors($validator)
                ->withInput();
      }


      $path = public_path() . '/images/product/avatar/';
      $name = time() . $request['productAvatar']->getClientOriginalName();

      $request['productAvatar']->move($path, $name);

      $product = Product::create([
          'title' => $request->input('title'),
          'price' => $request->input('price'),
          'ageMin' => $request->input('ageMin'),
          'ageMax' => $request->input('ageMax'),
          'stock' => $request->input('stock'),
          'description' => $request->input('description'),
          'condition' => $request->input('condition'),
          'category_id' => $request->input('subCategory'),
          'productAvatar' => $name,
          'user_id' => Auth::user()->id,
      ]);
      return redirect('/viewProduct/' . $product->id);
    }

    public function view($id){

      $product = Product::findOrFail($id);

      return view('viewProduct', [
        'product' => $product,
      ]);
    }

    public function viewEdit($id){
      $product = Product::findOrFail($id);

      if ($product->user_id != Auth::user()->id) {
        return redirect('/home');
      }

      $categories = Category::where('category_id', null)->get();
      $subCategories = $product->category->parentCategory->childrenCategories;

      return view('editProduct', [
        'product' => $product,
        'categories' => $categories,
        'subCategories' => $subCategories,
      ]);
    }

    public function edit(Request $request, $id){

          $user = Auth::user();

          $product = Product::findOrFail($id);

          if ($product->user_id != $user->id) {
            return redirect('/home');
          }

          Validator::extend('old_password', function ($attribute, $value, $parameters, $validator) { //Crea una validacion nueva para verificar password guardada en DB.
                return Hash::check($value, current($parameters));
          });

          $validator = Validator::make($request->all(), [
              'title' => 'required|string|max:255',
              'price' => 'required|integer',
              'ageMin' => 'required|integer|max:' . $request->input('ageMax'),
              'ageMax' => 'required|integer|min:' . $request->input('ageMin'),
              'stock' => 'required|integer',
              'avatar' => 'sometimes|max:99999999',
              'description' => 'required|max:500',
              'condition' => 'required',
              'subCategory' => 'required',
              'password' => 'required|old_password:' . $user->password,
          ]);

          if ($validator->fails()) {
            return redirect('/editProduct/' . $id)
                    ->withErrors($validator)
                    ->withInput();
          }

          $product->fill([
            'title' => $request->input('title'),
            'price' => $request->input('price'),
            'ageMin' => $request->input('ageMin'),
            'ageMax' => $request->input('ageMax'),
            'stock' => $request->input('stock'),
            'description' => $request->input('description'),
            'condition' => $request->input('condition'),
            'category_id' => $request->input('subCategory'),
          ]);

          if ($request->hasFile('avatar')) {

            $path = public_path() . '/images/product/avatar/';
            $name = time() . $request->file('avatar')->getClientOriginalName();

            $request->file('avatar')->move($path, $name);

            unlink($path . $product->productAvatar);

            $product->fill([
              'productAvatar' => $name
            ]);

          }

          $product->save();

          return redirect('/viewProduct/' . $id);

    }

    public function viewRegister(){

      $categories = Category::where('category_id', null)->get()->shuffle();

      return view('registerProduct', [
        'categories' => $categories,
      ]);
    }

    public function myProducts(){
      $user = Auth::user();

      $products = $user->products;

      return view('myProducts', [
        'products' => $products,
      ]);
    }

    public function userProducts($idUser){
      $user = User::findOrFail($idUser);

      $products = $user->products;

      return view('userProducts', [
        'products' => $products,
      ]);
    }
}
