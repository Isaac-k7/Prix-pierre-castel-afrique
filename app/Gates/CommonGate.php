<?php
namespace App\Gates;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;

class CommonGate
{
    public function isAdmin($user){

        $role = UserRole::where('id',$user->role_id)->first();  
        return $role->slug === 'admin' || $role->slug === 'filiale' ? true : false;
       // return $role->slug === 'admin' ? true : false;
    }

    public function isCandidat($user){
       
        $role = UserRole::where('id',$user->role_id)->first();     
        return $role->slug === 'candidat' ? true : false;
    }

   public function isFiliale($user){
       
        $role = UserRole::where('id',$user->role_id)->first();     
        return $role->slug === 'filiale' ? true : false;
    } /*  */
    
}
