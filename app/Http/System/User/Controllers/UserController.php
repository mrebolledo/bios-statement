<?php

namespace App\Http\System\User\Controllers;


use App\App\Controllers\AbstractController;
use App\Domain\System\User\User;
use App\Http\Auth\Events\UserRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends AbstractController
{
    public $icon = 'fa-users';

    public $title = 'Usuarios';

    public $middle = true;

    public function entity()
    {
        return User::class;
    }

    public function validation()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'roles' => 'required',
        ];
    }

    public function requiredVars()
    {
        return [
            'roles' => Role::all()
        ];
    }

    public function getColumns(): array
    {
        return [
            'Nombre',
            'Apellido',
            'Email',
            'Acciones',
        ];
    }

    public function entityPath()
    {
        return 'system.user';
    }

    protected function storeEntity(Request $request)
    {
        return $this->entity->create(array_merge($request->all(),[
            'password' => Hash::make(explode('@',$request->email)[0])
        ]));
    }

    protected function afterStore(Request $request, $user)
    {
        if(!$user->syncRoles($request->roles)) {
            return response()->json(['error' => 'No se sincronizaron los roles'],401);
        }
        //event(new UserRegistered($user));
    }

    protected function beforeDestroy($id)
    {
        User::findOrFail($id)->roles()->detach();

        return true;
    }
}
