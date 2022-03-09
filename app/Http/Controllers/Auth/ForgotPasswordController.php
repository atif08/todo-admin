<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Mail\EmailSendMocono;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use App\Traits\MoconoTrait;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Null_;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ForgotPasswordController extends Controller
{
    use ApiResponseTrait;
    use MoconoTrait;
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

   // use SendsPasswordResetEmails;
    public function forgetPasswordSendEmail(Request $request){
        $validated = $request->validate([
            'email' => 'required|exists:users',
        ]);
       // dd(request()->email);
        $user=User::where('email',request()->email)->where('type',1)->first();
        //dd($user);
        if($user){

            $data['forget_token']=Str::uuid();

            $data['user']=$user;
            $data['subject']='Forget Password';
            $data['emailTemplate']='emailTemplate.forgetPassword';

            Mail::to($user['email'])->send(new EmailSendMocono($data));
            $user->update(['forget_token'=>$data['forget_token']]);
            return $this->successResponse([], 'success');
        }else{
            return $this->failureResponse('Email not exists', '400', 'Error');
        }

    }

    public function forgetPassword(Request $request){
        $request->validate([
            'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:8'
        ]);
        if($user=User::where('email',request()->email)->where('type',1)->where('forget_token',request()->forget_token)->first()){
            User::where('email',request()->email)->where('type',1)->where('forget_token',request()->forget_token)->update(['password'=> Hash::make(request()->password),'forget_token'=>Null]);
            return $this->successResponse($user, 'success', Response::HTTP_CREATED);
        }else{
            return $this->failureResponse('Your token is expired!', '400', 'Error');
        }

    }

}
