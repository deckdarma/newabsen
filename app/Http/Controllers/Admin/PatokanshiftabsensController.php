<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Reply;
use App\Http\Controllers\AdminBaseController;
use App\Models\Patokanshiftabsen;
use App\Models\Company;
use App\Models\EmailTemplate;
use App\Models\Employee;
use App\Models\Holiday;
use App\Models\Dataskor;
use App\Models\Leavetype;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Patokanshiftabsen\UpdateRequest;
use App\Http\Requests;

/*
 * Patokanshiftabsen Controller of Admin Panel
 */

class PatokanshiftabsensController extends AdminBaseController
{
	
	
}