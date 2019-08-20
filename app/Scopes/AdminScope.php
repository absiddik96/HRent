<?php 
namespace App\Scopes;

use App\Models\UserRole;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class AdminScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $user_role = UserRole::where('role','admin')->first();
        $builder->where('user_role_id', $user_role->id);
    }
}