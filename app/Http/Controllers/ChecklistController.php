<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
Use App\Models\Checklist;
Use App\Models\Checktitle;
Use App\Models\Comment;
use App\Models\label;
use App\Models\Files;


class ChecklistController extends Controller
{
    public function storetitle(Request $request)
    {

        $checktitle = new Checktitle;
        $checktitle->title    = $request->checklist;
        $checktitle->cart_id  = $request->id;
        $checktitle->save();
        return 'check title';
    }

    public function deletechecktitle($checktitle_id)
    {
        $checktitle = Checktitle::find($checktitle_id);
        $checktitle->delete();
        return redirect()->back();
    }

    public function storelist(Request $request)
    {
        // return $request->all();
        $checklist =  new Checklist;
        $checklist->list = $request->list;
        $checklist->title_id = $request->title_id;
        $checklist->save();
        return 'checklist';
    }

    public function deletechecklist($list_id)
    {
        $checklist = Checklist::find($list_id);
        $checklist->delete();
        return redirect()->back();
    }

    public function storecomment(Request $request)
    {
        // return $request->all();
        $comment = new Comment;
        $comment->cart_id = $request->id;
        $comment->comment = $request->comment;
        $comment->user_id = Auth::user()->id;
        $comment->save();
        return 'comment';
    }

    public function commentdelete($comment_id)
    {
        $comment = Comment::find($comment_id);
        $comment->delete();
        return redirect()->back();
    }

    public function storelabel(Request $request)
    {
        // return $request->all();
        $label = new label;
        $label->cart_id = $request->id;
        $label->label = $request->label;
        $label->color = $request->color;
        $label->save();
        return 'label';
    }

     // Store Files //
     public function storefiles(Request $request)
     {
        //  return $request->all();
         $files = new Files();
         $files->cart_id = $request->id;

         $image = $request->select_file;
         $name = time() . $image->getClientOriginalExtension();
         $image->move(public_path('files'),$name);
         $files->files = $name;
         $files->save();
         return 'files';

     }

}
