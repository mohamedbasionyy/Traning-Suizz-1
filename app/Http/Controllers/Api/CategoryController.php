<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CategoriesModel;
use App\Models\content;
use App\Models\Product;
use App\Traits\GeneralTraits;
use Illuminate\Http\Request;
//use App\Models\admins;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    use GeneralTraits;

    public function index(){

        $category = CategoriesModel::select()->get();
        return response()->json($category);
        //$category = CategoriesModel::select('name_ar','name_en'.app()->getLocale().'as name')->get();
        //return response()->json($category);

        //return $this->returndata(key:'category',$category);
    }

    public function ById(request $request){

        $category = CategoriesModel::select()->find($request->id);
        if(!$category)
        return $this->returnError('001','not_found');

    }

    public function checkStatus(request $request){

        $category = CategoriesModel::find($request->id);

        $category::where('id',$request->id)->update(['active'=>$request->active]);
        return $this->returnsucsses('200',"okkkkay");
    }

    public function login(Request $request)
    {
        $rules=[
            'email' => 'required',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
            return $this->returnError('E001','invalid');
        }

        $credentials= $request -> only(['email','password']);
        $token=Auth::guard('admin-api')->attempt($credentials);

        if(!$token)
        return $this->returnError('E001','wrong token');

        $admin =Auth::guard('admin-api')->user();
        $admin->api_token = $token;

        return $this->returndata('admin', $admin ,'OK');


    }
    public function list()
    {
        $contents=content::all();
        return response()->json($contents);
    }

    public function create(Request $request)
    {
        $contents=content::create($request->all());
        return response()->json($contents);
    }

    public function update(Request $request,$id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        $post = content::findOrFail($id);
        $post->update($validatedData);
        return response()->json($post);
    }
    public function delete($id){
        content::destroy($id);
        return response()->json(['msg'=>'post deleted successfully.']);
    }

    public function show($id)
    {
        $post = content::find($id);
        return response()->json($post);
    }
}
