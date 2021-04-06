<?php
namespace App\Repositories\Admin\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Eloquent\BaseRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ProfileUserRepository extends BaseRepository implements ProfileUserInterface
{
    public function model(){
        return User::class;
    }

    public function updateProfileUser($data){
        $user= Auth::user();

        if(isset($data['avatar'])){
            $fileName = Str::uuid() . '.' . $data['avatar']->getClientOriginalExtension();
            Storage::disk('local')->put($fileName, file_get_contents($data['avatar']), 'public');
            $data['avatar'] = $fileName;
            $user->avatar = $data['avatar'];
            $user->save();
        }

        if ($data['password'] && $data['password']=$data['password-c']){
                $data['password']=bcrypt($data['password']);
            }
        else{
                $data['password']=$user->password;
            }
        $user->update($data);

        return $user;
    }
}
