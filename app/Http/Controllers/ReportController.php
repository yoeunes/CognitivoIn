<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Opportunity;
use App\OpportunityTask;
use Carbon\Carbon;
use DB;

class ReportController extends Controller
{
    public function index(Taxpayer $taxPayer, Cycle $cycle)
    {
        return view('reports/index');
    }

    public function opportunity(Profile $profile, $startDate, $endDate)
    {
        if (isset($profile))
        {
            $data = $this->opportunityQuery($profile, $startDate, $endDate);

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


    public function opportunityQuery(Taxpayer $taxPayer, $startDate, $endDate)
    {
        DB::connection()->disableQueryLog();

        return Opportunity::with('relationship')
        ->get();
    }



    public function opportunitytaskQuery(Taxpayer $taxPayer, $startDate, $endDate)
    {
        DB::connection()->disableQueryLog();

        return OpportunityTask::get();
    }

}
