<?php

namespace App\Observers;

use App\Models\ReplySupport;
use Illuminate\Support\Str;

class ReplySupportObserver
{
    /**
     * Handle the ReplySupport "creating" event.
     */
    public function creating(ReplySupport $replySupport): void
    {
        $replySupport->id = Str::uuid();
    }
}
