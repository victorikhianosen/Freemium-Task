<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Auth\Access\Response;

class CustomerPolicy
{
    public function modify(User $user, Customer $customer): Response
    {
        return $user->id === $customer->user_id
        ? Response::allow()
        : Response::deny('Unauthorized to modify this customer.');
    }
}
