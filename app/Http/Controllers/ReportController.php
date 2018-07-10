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

    $raw = DB::select('SELECT opp.created_at as date,opp.name,opp.description,opp.value,opp.currency,
      (select  customer_alias from relationships where opp.relationship_id=relationships.id) as customer,
      (select  customer_email from relationships where opp.relationship_id=relationships.id) as email,
      (select  name from profiles where id= (select max(assigned_to) from opportunity_tasks where opportunity_tasks.opportunity_id=opp.id) ) as contact,
      (select  name from items where id= (select max(item_id) from carts where carts.opportunity_id=opp.id) ) as Item,
      (select max(quantity) from carts where carts.opportunity_id=opp.id) as quantity,
      (select  name from profiles where id= (select max(ot.completed_by) from opportunity_tasks ot  where ot.opportunity_id=opp.id) ) as complete_by,
      (select max(ot.completed_at) from opportunity_tasks ot  where ot.opportunity_id=opp.id) as complete_date
      FROM opportunities as opp
      where opp.created_at between "' . $startDate . '" and "' . $endDate .'"');

      $raw = collect($raw);
      return $raw;
    }



    public function opportunitytaskQuery(Profile $profile, $startDate, $endDate)
    {
      DB::connection()->disableQueryLog();

      $raw = DB::select('SELECT opportunity_tasks.title,opportunity_tasks.description,
        opportunity_tasks.date_started,opportunity_tasks.date_ended,
        opportunity_tasks.date_reminder,opportunities.description,opportunities.deadline_date,
        opportunities.name,opportunities.created_at as date
        from opportunity_tasks
        join opportunities on opportunities.id=opportunity_tasks.opportunity_id
        where opportunities.created_at between "' . $startDate . '" and "' . $endDate .'"');

        $raw = collect($raw);
        return $raw;
      }

    }
