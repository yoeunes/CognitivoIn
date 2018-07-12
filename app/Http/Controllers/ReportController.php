<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\Opportunity;
use App\OpportunityTask;
use Carbon\Carbon;
use DB;

class ReportController extends Controller
{
  public function index(Profile $profile)
  {

    return view('reports/index');
  }

  public function opportunity(Profile $profile, $startDate, $endDate)
  {
    if (isset($profile))
    {
      $data = $this->opportunityQuery($profile, $startDate, $endDate);
      //return response()->json($data);
      return view('reports/opportunity')
      ->with('header', $profile)
      ->with('data', $data)
      ->with('strDate', $startDate)
      ->with('endDate', $endDate);
    }
  }
  public function opportunityTask(Profile $profile, $startDate, $endDate)
  {
    if (isset($profile))
    {
      $data = $this->opportunitytaskQuery($profile, $startDate, $endDate);

      return view('reports/opportunitytask')
      ->with('header', $profile)
      ->with('data', $data)
      ->with('strDate', $startDate)
      ->with('endDate', $endDate);
    }
  }


  public function opportunityQuery(Profile $profile, $startDate, $endDate)
  {

    DB::connection()->disableQueryLog();

      $opportunity=Opportunity::with('tasks')
      ->with('relationship')
      ->with('carts')
      ->get();
      return $opportunity;
    }



    public function opportunitytaskQuery(Profile $profile, $startDate, $endDate)
    {
      DB::connection()->disableQueryLog();
      $opportunitytask=OpportunityTask::with('opportunity')
      ->get();

        return $opportunitytask;
      }

    }
