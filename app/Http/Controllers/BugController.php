<?php

namespace App\Http\Controllers;

use App\Models\Bug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BugController extends Controller
{
    public function report(Request $request)
    {
        $page_reported = $request->query('page_reported');
        return view('bug.report', compact('page_reported'));
    }

    public function report_submit(Request $request)
    {
        $bug = new Bug();
        $bug->user_id = Auth::user()->id;
        $bug->title = $request->input('title');
        $bug->description = $request->input('description');
        $bug->status = "En attente";
        $bug->page_trigger = $request->input('pagetriggered');
        $bug->save();
        return redirect(route('bug.bug_submited'));
    }

    public function report_submited(Request $resquest)
    {
        return view('bug.bug_submited');
    }
}
