<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    const UPDATED_AT = 'update_at';
    const CREATED_AT = 'create_at';

    protected $table = 'user';
    public $timestamps = false;


    /**
     * @return string 根据id获取用户信息
     */

    public function getuserinfo($uid)
    {
       	$users=User::where('id',$uid)->first();
       		
        return $users;
    }










//    protected $fillable=['phone','pwd','paypwd'];//设置允许批量赋值的字段

//    protected $guarded=[]; //设置不允许批量赋值的字段可以为空

//    public $timestamps=true;//自动维护时间戳
//
//     protected function getDateFormat()
//     {
//         return time();
//     }
//
//     protected function asDateTime($value)//不格式化时间戳
//     {
//         return $value;
//     }
}
