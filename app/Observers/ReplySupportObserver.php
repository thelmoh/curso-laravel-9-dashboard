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
        $replySupport->admin_id = auth()->user()->id;
        $replySupport->id = Str::uuid();
    }
}
