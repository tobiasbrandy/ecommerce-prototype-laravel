<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;

use Validator;

use Hash;

use App\Product;

use App\User;

class UserController extends Controller
{
  public function edit(Request $request){

    $user = Auth::user();

    Validator::extend('old_password', function ($attribute, $value, $parameters, $validator) { //Crea una validacion nueva para verificar password guardada en DB.
          return Hash::check($value, current($parameters));
    });

    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
        'lastName' => 'required|max:255',
        'avatar' => 'sometimes|max:99999999|image',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'old_password' => 'required|old_password:' . $user->password,
        'password' => 'min:6|confirmed',
    ]);

    if ($validator->fails()) {
      return redirect('/editarUsuario/')
              ->withErrors($validator)
              ->withInput();
    }

    $user->fill([
      'name' => $request->input('name'),
      'lastName' => $request->input('lastName'),
      'email' => $request->input('email'),
    ]);

    if (trim($request->input('password')) != "") {
      $user->fill([
        'password' => bcrypt($request->input('password'))
      ]);
    }

    if ($request->hasFile('avatar')) {

      $path = public_path() . '/images/avatar/';
      $name = time() . $request->file('avatar')->getClientOriginalName();

      $request->file('avatar')->move($path, $name);

      if ($user->avatarPath != 'default.jpg') {
        unlink($path . $user->avatarPath);
      }


      $user->fill([
        'avatarPath' => $name
      ]);

    }

    $user->save();

    return redirect('/viewUser/' . $user->id);

  }

  public function view($id){
    $user = User::findOrFail($id);

    return view('viewUser', [
      'user' => $user,
    ]);
  }

  public function wishlist(){
    $user = Auth::user();

    $products = $user->wishProducts()->get()->shuffle();

    return view('wishlist', [
      'products' => $products,
    ]);
  }

  public function checkout(){
    $user = Auth::user();

    $products = $user->shopProducts()->get();

    foreach ($products as $product) {
      if ($product->stock <= 0) {
        $user->shopProducts()->detach($product);
      }
    }

    $products = $user->shopProducts()->get();

    $totalPrice = 0;

    foreach ($products as $product) {
      $totalPrice += $product->price;
    }

    return view('checkout', [
      'products' => $products,
      'totalPrice' => $totalPrice,
    ]);
  }
}
