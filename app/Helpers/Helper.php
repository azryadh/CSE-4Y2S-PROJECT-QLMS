<?php


namespace App\Helpers;


use Illuminate\Support\Facades\DB;

class Helper
{

   public static function checkRole($user_id){
       $role = DB::table('role_user')->where('user_id',$user_id)->first();
       return $role->role_id;

    }

   public static function generateToken()
    {
        return rand(1, 10) . microtime();
    }

}
