<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class CalendarController extends Controller
{
    
    // public function listEvents()
    // {
    //     $events = Event::select('id', 'title', 'color', 'start', 'end')->get();
    //     // dd($events);
    //     $eventos = [];

    //     foreach ($events as $event) {
    //         
    //     }

    //     // dd($eventos);
    //     // return response()->json($eventos);
    // }

    public function index()
    {
        $events = Event::all();
        // dd($events);
        $eventos = [];

        foreach ($events as $event) {
            $id = $event->id;
            $title = $event->title;
            $color = $event->color;
            $start = $event->start;
            $end = $event->end;

            $eventos[] = [
                'id' => $id,
                'title' => $title,
                'color' => $color,
                'start' => $start,
                'end' => $end,
            ];
        }
        // dd($eventos);
        return view('calendar')->with('eventos', $eventos);
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
    public function store(Request $request)
    {
        //
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
