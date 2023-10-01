<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\TicketStatusChanged;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::latest()->paginate(10);
        return view('tickets.index',compact('tickets'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::get();
        return view('tickets.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        Ticket::create($request->all());

        User::find($request->user_id)->notify(new TicketStatusChanged($request->title, $request->status));

        return redirect()->route('tickets.index')->with('success','Ticket created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        return view('tickets.show',compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        $users = User::get();
        return view('tickets.edit',compact('ticket', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $ticketData = $request->all();
        $ticketData['status'] = $request->status;
        $ticket->update($ticketData);

        User::find($request->user_id)->notify(new TicketStatusChanged($request->title, $request->status));

        return redirect()->route('tickets.index')->with('success','Ticket updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('tickets.index')->with('success','Ticket deleted successfully');
    }
}
