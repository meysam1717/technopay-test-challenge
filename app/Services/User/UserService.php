<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

final readonly class UserService
{

    /**
     * @param array<string, mixed> $eagerLoads
     * @return Collection<User>
     */
    public function getAdmins(array $eagerLoads = []): Collection
    {
        return User::isAdmin()->with($eagerLoads)->get();
    }

}
