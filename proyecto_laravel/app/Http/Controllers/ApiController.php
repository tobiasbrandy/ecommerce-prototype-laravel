<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Category;

use App\Product;

use Auth;

use MP;

class ApiController extends Controller
{
    public function subCategories($id){
      $subCategories = Category::where('category_id', $id)->get();

      $arraySubCategories = $subCategories->all();

      $json = json_encode($arraySubCategories);

      echo $json;
    }

    public function wishlist($idProduct){
      $user = Auth::user();
      $product = Product::findOrFail($idProduct);
      if (!($user->products()->get()->contains($product))) {
        $user->wishProducts()->attach($idProduct);

        $response = ['success' => true];
      } else {
        $response = ['success' => false];
      }
      echo json_encode($response);
    }

    public function unwishlist($idProduct){
      $user = Auth::user();
      $product = Product::findOrFail($idProduct);
      if ($user->wishProducts()->get()->contains($product)) {
        $user->wishProducts()->detach($idProduct);

        $response = ['success' => true];
      } else {
        $response = ['success' => false];
      }
      echo json_encode($response);
    }

    public function shoplist($idProduct){
      $user = Auth::user();
      $product = Product::findOrFail($idProduct);
      if (!($user->products()->get()->contains($product))) {
        $user->shopProducts()->attach($idProduct);

        $response = ['success' => true];
      } else {
        $response = ['success' => false];
      }
      echo json_encode($response);
    }

    public function unshoplist($idProduct){
      $user = Auth::user();
      $product = Product::findOrFail($idProduct);
      if ($user->shopProducts()->get()->contains($product)) {
        $user->shopProducts()->detach($idProduct);

        $response = ['success' => true];
      } else {
        $response = ['success' => false];
      }
      echo json_encode($response);
    }

    public function createPreference(Request $request){
      $user = Auth::user();
      $products = $user->shopProducts()->get();

      $preferenceData = [
        'items' => [],
        'payer' => [
          'name' => $user->name,
          'surname' => $user->lastName,
          'email' => $user->email
        ],
        'back_urls' => [
          'success' => 'localhost:8000/api/mercadopago/response/success',
          'pending' => 'localhost:8000/api/mercadopago/response/pending',
          'failure' => 'localhost:8000/api/mercadopago/response/failure'
        ],
        'auto_return' => 'approved'
      ];

      foreach ($products as $product) {
        $preferenceData['items'][] = [
          'id' => $product->id,
          'category_id' => $product->category->name,
          'title' => $product->title,
          'description' => $product->description,
          'picture_url' => public_path() . "/images/product/avatar/" . $product->productAvatar,
          'quantity' => intval($request->input('quantity' . $product->id)),
          'currency_id' => 'ARS',
          'unit_price' => $product->price
        ];

        $product->stock = $product->stock - intval($request->input('quantity' . $product->id));
        $product->save();

        $request->session()->put($product->id, intval($request->input('quantity' . $product->id)));
      }

      $preference = MP::create_preference($preferenceData);

      //dd($preference);

      return redirect($preference['response']['sandbox_init_point']);
    }

    public function response(Request $request, $value){
      $user = Auth::user();
      $products = $user->shopProducts;
      if ($value == 'success' || $value == 'pending') {
        foreach ($products as $product) {
          $user->shopProducts()->detach($product->id);
        }
        $request->session()->forget($product->id);
      }
      if ($value == 'failure') {
        foreach ($products as $product) {
          $quantity = $request->session()->pull($product->id);

          $product->stock = $product->stock + $quantity;
          $product->save();
        }
      }


      return view('/responseCheckout', [
        'response' => $value
      ]);
    }

    public function deleteProduct($idProduct){
      $product = Product::findOrFail($idProduct);

      $product->delete();

      $response = ['success' => true];
      echo json_encode($response);
    }
}
