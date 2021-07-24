<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $fixed = Note::select("id", "content", "fixed AS type", "bgcolor")->where("user_id", Auth::id())->where('fixed', 1)->orderBy("updated_at", "desc")->get();
        $other = Note::select("id", "content", "fixed AS type", "bgcolor")->where("user_id", Auth::id())->where('fixed', 0)->orderBy("updated_at", "desc")->get();
        echo json_encode(array('fixed' => $fixed, 'other' => $other));
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
        if (!Auth::check()) {
            echo json_encode(array('status' => false, 'msg' => '尚未登入!!'));
            return;
        }

        $validator = Validator::make($request->all(), [
            'content' => 'required',
        ], [
            'content.required' => '內容不可為空',
        ]);
        if ($validator->errors()->any()) {
            echo json_encode(array('status' => false, 'msg' => $validator->errors()->all()));
            return;
        }

        $note = new Note;
        $note->content = $request['content'];
        $note->user_id = Auth::id();
        if ($note->save()) {
            $id = Note::select("id")->where("user_id", $note->user_id)->orderBy("updated_at", "desc")->first();
            echo json_encode(array('status' => true, "id" => $id, "content" => $note->content));
        } else
            echo json_encode(array('status' => false, 'msg' => '新增失敗'));
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
    public function updateFixed($id = '', $type = 1)
    {
        $type = !$type;
        if (Note::where("user_id", Auth::id())->where("id", $id)->update(['fixed' => $type]))
            echo json_encode(array('status' => true));
        else
            echo json_encode(array('status' => false));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Note::where("user_id", Auth::id())->where("id", $id)->delete())
            echo json_encode(array('status' => true, 'msg' => '刪除成功'));
        else
            echo json_encode(array('status' => false, 'msg' => '刪除失敗'));
    }
}
