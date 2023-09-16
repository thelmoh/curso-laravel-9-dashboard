<?php

namespace App\Observers;

use App\Models\Admin;
use Illuminate\Support\Str;

class AdminObserver
{
    /**
     * Handle the Admin "creating" event.
     */
    public function creating(Admin $admin): void
    {
        $admin->id = Str::uuid();
    }
}
