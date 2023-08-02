<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskAssign;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Auth;
use Illuminate\Support\Facades\Notification;
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with('userInfo')->where('assign_by',Auth::user()->id)->get();
        return Inertia::render('Task/Index',compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all()->except(Auth::user()->id);
        return Inertia::render('Task/Create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        Task::create([
            'title'=>$request->title,
            'status'=>1,
            'description'=>$request->description,
            'deadline'=>$request->deadline,
            'assign_to'=>$request->assign_to,
            'assign_by'=>Auth::user()->id,
        ]);

        $user = User::find($request->assign_to);
        $user->notify(new TaskAssign());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    /**
     * Display a list of task that assign to logged-in user
     */
    public function assignToMe(){
        $tasks = Task::with('assignerInfo')->where('assign_to',Auth::user()->id)->get();
        return Inertia::render('Task/Assigned',compact('tasks'));
    }
}
