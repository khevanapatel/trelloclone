<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Board;

class BoardControllers extends Controller
{
    // Show Board List //
    public function index()
    {
        $board = Board::get();
        return view('board.index',['board'=>$board]);
    }

    // Store Board //
    public function boardstore(Request $request)
    {

        $validator = Validator::make($request->all(),['board'=>'required|max:255|unique:board,title',]);

        if ($validator->fails())
        {
            return redirect()->back()
                ->withErrors($validator->errors())->withInput();
        }

        $board = new Board;
        $board->title = $request->board;
        $board->image = $request->grayButton;
        $board->user_id = Auth::user()->id;
        $board->save();
        return redirect()->route('boards');

    }
    // Board Delete //
    public function boarddelete($board_id)
    {
        $board = Board::find($board_id);
        $board->delete();
        return redirect()->back();
    }

    public function testing()
    {
        return view('board.testing');
    }


}
