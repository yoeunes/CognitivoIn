<?php

namespace App\Http\Controllers;
use App\ItemMovement;
use App\Profile;
use App\Http\Resources\ItemMovementResource;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ItemMovementController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index(Profile $profile, $filterBy)
  {
    return ItemMovementResource::collection(
      ItemMovement::with('item')->orderBy('created_at')->paginate(100));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
      //
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Profile $profile,Request $request)
    {

      if ($request->category==1)
      {
        $itemMovement= new ItemMovement();
            $itemMovement->item_id=$request->item_id;
        $itemMovement->location_id=$request->fromLocationId;
        $itemMovement->debit=$request->quantity;
        $itemMovement->credit=0;
        $itemMovement->date=Carbon::now();
        $itemMovement->save();

        $itemMovement= new ItemMovement();
              $itemMovement->item_id=$request->item_id;
        $itemMovement->location_id=$request->toLocationId;
        $itemMovement->debit=0;
        $itemMovement->credit=$request->quantity;
        $itemMovement->date=Carbon::now();
        $itemMovement->save();
      }
      else if($request->category==2){
        $itemMovement= new ItemMovement();
              $itemMovement->item_id=$request->item_id;
        $itemMovement->location_id=$request->fromLocationid;
        $itemMovement->debit=$request->quantity;
        $itemMovement->credit=0;
        $itemMovement->date=Carbon::now();
        $itemMovement->save();
      }
      else {
        $itemMovement= new ItemMovement();
              $itemMovement->item_id=$request->item_id;
        $itemMovement->location_id=$request->toLocationId;
        $itemMovement->debit=0;
        $itemMovement->credit=$request->quantity;
        $itemMovement->date=Carbon::now();
        $itemMovement->save();
      }
      return response()->json(200,200);
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
      //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
      //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
      //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
      //
    }
  }
