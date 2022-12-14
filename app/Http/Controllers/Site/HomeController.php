<?php

namespace App\Http\Controllers\Site;


use App\Classes\Reply;
use App\Events\CompanyCreated;
use App\Http\Controllers\SiteBaseController;
use App\Http\Requests\Site\ContactSubmitRequest;
use App\Http\Requests\Site\SignupRequest;
use App\Mail\CompanySignedUp;
use App\Mail\SupportReceived;
use App\Mail\SupportSent;
use App\Mail\VerifyEmail;
use App\Models\Admin;
use App\Models\Company;
use App\Models\ContactRequest;
use App\Models\Country;
use App\Models\FaqCategory;
use App\Models\Feature;
use App\Models\Pages;
use App\Models\Plan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class HomeController extends SiteBaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view("admin.login", $this->data);
    }

 
}
