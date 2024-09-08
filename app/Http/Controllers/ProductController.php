<?php

namespace App\Http\Controllers;
use App\Events\UserLoggedIn;
use App\Models\Admin;
use App\Models\Post;
use App\Models\Product;
use App\Models\User;
use App\Traits\GeneralTraits;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
use GeneralTraits;
    public function login(Request $request)
    {

        try {
            $rules = [
                "email" => "required",
                "password" => "required"

            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            //login

            $credentials = $request->only(['email', 'password']);

            $token = Auth::guard('user-api')->attempt($credentials);  //generate token

            if (!$token)
                return $this->returnError('E001', 'wrong email or password');

            $user = Auth::guard('user-api')->user();
            $user ->api_token = $token;
            //return token
            return $this->returnData('user', $user);  //return json response

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }


     public function index()
     {

         //$this->authorize('index', Product::class);

         $posts = Product::all();
         return response()->json($posts);

     }


     public function create(Request $request)
     {
         $product=Product::create($request->all());
         return response()->json($product);
     }


     /**
      * @throws AuthorizationException
      */
    public function update(Request $request,id $id)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'password' => 'nullable'
        ]);

        $product = Product::findOrFail($id);
        $product->update($validatedData);
        return response()->json($product);
    }


    public function destroy($id)
    {

        $product=Product::find($id);
        $product::destroy($id);
        return response()->json('ok');
    }

    public function sum($x,$y)
    {
        return $x + $y;
    }


    public function register(Request $request)
    {
     $user =User::create($request->all());
//     event(new UserLoggedIn($user));
     return response()->json(['message'=>'User registered successfully']);
    }

}
