<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskStatusController extends Controller
{
    /**
     * Change the status of a task to Start
     */
    public function taskStart($id){
        Task::find($id)->update([
            'status'=>2,
        ]);
    }
    /**
     * Change the status of a task to Done
     */
    public function taskDone($id){
        Task::find($id)->update([
            'status'=>3,
        ]);
    }
}
