<?php
namespace App\Traits;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

trait GeneralTraits
{
    public function returnValidationError($code = "E001", $validator)
    {
        return $this->returnError($code, $validator->errors()->first());
    }


    public function returnCodeAccordingToInput($validator)
    {
        $inputs = array_keys($validator->errors()->toArray());
        $code = $this->getErrorCode($inputs[0]);
        return $code;
    }
    public function returnError($errnum,$msg){

        return response()->json([
            'status'=> false,
            'errnum'=>$errnum,
            'msg'=>$msg
        ]);

    }

    public function returnsucsses($errnum="",$msg=""){

        return response()->json([
            'status'=> true,
            'errnum'=>"Done",
            'msg'=>$msg
        ]);

    }
    public function returndata($key,$value,$msg){

        return response()->json([
            'status'=> true,
            'errnum'=>"Done",
            'msg'=>$msg,
            $key=>$value
        ]);

    }


}
