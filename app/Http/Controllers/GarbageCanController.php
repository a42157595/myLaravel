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
            ->orderBy("updated_at", "desc")->get();
        echo json_encode($note);
    }
}
