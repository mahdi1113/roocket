<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiveCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'code',
        'expired_at'
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeVerifyCode($query, $code , $user)
    {
        
        return !! $user->activeCodes()->whereCode($code)->where('expired_at' , '>' , now())->first();
    }

    public function scopeGenerateCode($query,$user)
    {
        if($activeCode = $this->getAliveCodeForUser($user)){
            $code = $activeCode->code;
        }else{
            do{
                $code = mt_rand(100000,999999);
            }while($this->checkCode($user,$code));
            $user->activeCodes()->create([
                'code' => $code,
                'expired_at' => now()->addMinute(10),
            ]);
        }
        return $code;
    }

    private function checkCode($user,$code)
    {
        
        return !! $user->activeCodes()->whereCode($code)->first();
    }

    private function getAliveCodeForUser($user)
    {
        return $user->activeCodes()->where('expired_at' , '>' , now())->first();
    }

    
}
