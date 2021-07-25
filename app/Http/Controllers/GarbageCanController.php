<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Note;

class GarbageCanController extends Controller
{
    public function index()
    {
        $note = Note::select("id", "content", "bgcolor")
            ->where("user_id", Auth::id())->whereNotNull('deleted_at')
            ->orderBy("updated_at", "desc")->onlyTrashed()->get();
        echo json_encode($note);
    }

    public function recovery($id = 'a')
    {
        if (Note::where("user_id", Auth::id())->where("id", $id)->onlyTrashed()->update(['deleted_at' => null]))
            echo json_encode(array('status' => true));
        else
            echo json_encode(array('status' => false));
    }
}
