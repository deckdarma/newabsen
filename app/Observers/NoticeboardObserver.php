<?php

namespace App\Observers;

use App\Models\EmailTemplate;
use App\Models\Employee;
use App\Models\Noticeboard;
use App\Models\Setting;
use Illuminate\Support\Facades\URL;

class NoticeboardObserver
{
    /**
     * Handle the noticeboard "created" event.
     *
     * @param  \App\Models\Noticeboard $noticeboard
     * @return void
     */


    public function saving(Noticeboard $noticeboard)
    {
        if (admin()) {
            $noticeboard->company_id = 1;
        }

    }

}
