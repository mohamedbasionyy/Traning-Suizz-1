<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use http\Env\Response;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class PostPolicy
{
use HandlesAuthorization;
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
    }

    /*public function index(User $user): bool
    {
        return $user->role === 'admin';
    }*/

}
