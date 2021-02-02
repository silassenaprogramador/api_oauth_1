<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    

    /**
     * 
     */
    public function login(Request $request){

        try{

            $dados = request(['email','password']);

            if(!Auth::attempt($dados)){
                return response()->json(['error'=>'não autorizado!'], 401);
            }

            $user = $request->user();
            $user->token = $user->createToken('token')->accessToken;
    
            return response()->json(['user'=>$user],200);

        }catch(\Exception $e){

            return response()->json(['error'=> $e->getMessage()], 400);
        }       
    }

  
    /**
     * 
     */
    public function logout(Request $request){

        try{

            $token_revogado = $request->user()->token()->revoke();

            if($token_revogado){
    
                return response()->json(['message'=>'logout efetuado com sucesso!'],200);
            }
    
            return response()->json(['message'=>'não foi possivel revogar o token'],400);

        }catch(\Exception $e){

            return response()->json(['error'=> $e->getMessage()], 400);
        }       
    }


}
