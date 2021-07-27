<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Label;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use stdClass;

class NoteController extends Controller
{

    public function index(Request $request)
    {
        if ($request['label'] == '') {
            $fixed = Note::select("id", "content", "fixed AS type", "bgcolor")->where("user_id", Auth::id())->where('fixed', 1)->orderBy("updated_at", "desc")->get();
            $other = Note::select("id", "content", "fixed AS type", "bgcolor")->where("user_id", Auth::id())->where('fixed', 0)->orderBy("updated_at", "desc")->get();
            echo json_encode(array('fixed' => $fixed, 'other' => $other));
        } else {
            $label = Label::select('id')->where('content', $request['label'])->get();
            if (isset($label[0])) {
                $fixed = Note::select("id", "content", "fixed AS type", "bgcolor")->where('label_id', $label[0]->id)->where("user_id", Auth::id())->where('fixed', 1)->orderBy("updated_at", "desc")->get();
                $other = Note::select("id", "content", "fixed AS type", "bgcolor")->where('label_id', $label[0]->id)->where("user_id", Auth::id())->where('fixed', 0)->orderBy("updated_at", "desc")->get();
                echo json_encode(array('fixed' => $fixed, 'other' => $other));
            }
        }
    }

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
            echo json_encode(array('status' => true, 'msg' => '新增成功', "id" => $id->id, "content" => $note->content));
        } else
            echo json_encode(array('status' => false, 'msg' => '新增失敗'));
    }

    public function updateFixed($id = '', $type = 1)
    {
        $type = !$type;
        if (Note::where("user_id", Auth::id())->where("id", $id)->update(['fixed' => $type]))
            echo json_encode(array('status' => true));
        else
            echo json_encode(array('status' => false));
    }

    public function destroy($id)
    {
        if (Note::where("user_id", Auth::id())->where("id", $id)->delete())
            echo json_encode(array('status' => true, 'msg' => '刪除成功'));
        else
            echo json_encode(array('status' => false, 'msg' => '刪除失敗'));
    }

    public function changeBgColor(Request $request, $id = 0)
    {
        if (Note::where("user_id", Auth::id())->where("id", $id)->update(['bgcolor' => $request['color']]))
            echo json_encode(array('status' => true));
        else
            echo json_encode(array('status' => false));
    }

    public function addLabel(Request $request)
    {
        $label = new Label;
        $label->user_id = Auth::id();
        $label->content = $request['content'];
        if ($label->save())
            echo json_encode(array('status' => true, 'msg' => '新增成功'));
        else
            echo json_encode(array('status' => false, 'msg' => '新增失敗'));
    }

    public function getLabel()
    {
        echo json_encode(Label::select("content")->where("user_id", Auth::id())->get());
    }

    public function updateNoteLabel($id = '', $label = '')
    {
        $user_id = Auth::id();
        if ($label == '預設') {
            $labelID = array();
            $labelID[0] = new stdClass();
            $labelID[0]->id = '0';
        } else
            $labelID = Label::select('id')->where('user_id', $user_id)
                ->where('content', $label)->get();
        if (isset($labelID[0]))
            if (Note::where('user_id', $user_id)->where('id', $id)->update(['label_id' => $labelID[0]->id]))
                echo json_encode(array('status' => true, 'msg' => '新增標籤成功'));
            else
                echo json_encode(array('status' => false, 'msg' => '新增標籤失敗'));
        else
            echo json_encode(array('status' => false, 'msg' => '新增標籤失敗'));
    }

    public function deleteLabel($content = '')
    {
        $id = Label::select('id')->where('user_id', Auth::id())->where('content', $content)->get();
        if (isset($id[0])) {
            if (Label::where('id', $id[0]->id)->delete()) {
                echo json_encode(array('status' => true, 'msg' => '刪除標籤成功'));
                return;
            }
        }
        echo json_encode(array('status' => false, 'msg' => '刪除標籤失敗'));
    }
}
