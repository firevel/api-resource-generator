<?php

namespace Firevel\ApiResourceGenerator\Traits;

use App\Models\User;

trait Authenticates
{
    protected function authenticate(?User $user = null): self
    {
        $user = $user ?? factory(User::class)->create();

        $this->be($user);

        return $this;
    }
}
