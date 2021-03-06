<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\view;
use Illuminate\Support\Facades\Input;
use App\Models\Listing;
use App\Models\Cartpop;
use App\Models\Card;
use App\Models\User;
use App\Models\Board;
use App\Models\Checktitle;
Use App\Models\Comment;
use App\Models\label;
use App\Models\Files;

// use Validator;
class ListingController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }

    // Display all Data //
    public function index(Request $request,$id)
    {
        // return $request->all();
        $label    = label::get();
        $carts    = Card::get();
        $user     = User::get();
        $file     = Files::get();
        $lists    = Board::where('id',$id)->first();
        $comment  = Comment::get();
        $check    = Checktitle::with('checklist')->get();
        $cartfile = Cartpop::get();
        $listings = Listing::with('board')->where('user_id',Auth::user()->id)->where('board_id',$id)->orderBy('created_at','asc')->get();
        return view('listing/index',compact('listings','carts','user','lists','check','comment','label','file','cartfile'));
    }

    public function new()
    {
        return view('listing/new');
    }

    // Store Lists //
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),['list_name'=>'required|max:255',]);

        if ($validator->fails())
        {
            return redirect()->back()
                ->withErrors($validator->errors())->withInput();
        }

        $listing = new Listing;
        $listing->title    = $request->list_name;
        $listing->board_id = $request->board_id;
        $listing->user_id = Auth::user()->id;
        $listing->save();
        return redirect()->back();
    }

    // Edit List //
    public function edit($listing_id)
    {
        $listing = Listing::find($listing_id);
        return view('listing/edit',['listing'=>$listing]);
    }

    // Update List //
    public function update(Request $request)
    {

        $validator = Validator::make($request->all(),['list_name'=>'required|max:255']);

        if ($validator->fails()){
            return redirect()->back()->withErros($validator->errors())->withInput();
        }

        $listing = Listing::find($request->list_id);
        $listing->title = $request->list_name;
        $listing->update();
        return 123;
    }

    // Delete Listing //
    public function destroy($listing_id)
    {
        $listing = Listing::find($listing_id);
        $listing->delete();
        return redirect()->back();
    }

    // Store Data //
    public function storedata(Request $request)
    {
         $cart = Cartpop::where('card_id',$request->id)->first();

        if(!$cart)
        {
            $file= new  Cartpop();
            $file->description = $request->show;
            $file->date        = $request->start;
            $file->card_id     = $request->id;
            $file->cover       = $request->cover;
            $file->save();
            return 'added';

        }
        else
        {
            if($request->show != null)
            {
                $cart->description = $request->show;
            }
            if($request->start != null)
            {
                $cart->date = $request->start;
            }
            if($request->cover != null)
            {
                $cart->cover = $request->cover;
            }
            if($request->id != null)
            {
                $cart->card_id = $request->id;
            }
            $cart->save();
            return 'updated';
        }
    }

    // Delete Function //
    public function deletefiles($id){

        $listing = Cartpop::find($id);
        $listing->delete();
        return redirect()->back();
    }

    // Get Model Data Display //
    public function getchecklist(Request $request)
    {
            $checktitle = Checktitle::with('checklist')->where('cart_id',$request->cilckid)->get();
            $comment    = Comment::with("user")->where('cart_id',$request->cilckid)->get();
            $label      = label::where('cart_id',$request->cilckid)->get();
            $file       = Files::where('cart_id',$request->cilckid)->get();
            $cartfile   = Cartpop::where('card_id',$request->cilckid)->first();
            $card       = Card::where('id',$request->cilckid)->first();
            $div ='';
            $list = '';
            $com = '';
            $labs = '';
            $select = '';
            if($checktitle){
                foreach($checktitle as $check){

                    $div .= $check->title.'<br>';

                    foreach($check->checklist as $listname){

                        if($check->id == $listname->title_id){

                            $list .= '<input type="checkbox" name="checklist" id="checklist" value'.$listname->id.'>'.$listname->list.'</br>';

                        }
                    }
                }
            }

            if($comment){
                foreach($comment as $comm){

                    $com .= $comm->id.$comm->comment.'<br>';

                    foreach($comm->user as $user)
                    {
                        $username = $user->name;
                    }
                }
            }
            if($label){
                foreach($label as $lab){

                    $labs .= $lab->label.'<br>';
                }
            }
            if($file){
                foreach($file as $files){

                    $select .= ' <img src="'.asset('files/'.$files->files).'" height="80" width="80">'.'<br>';
                }
            }
            if($cartfile)
            {
                $descr   = $cartfile->description;
                $carddate = $cartfile->date;
                $cover = '<div class="modal-header cover" style="background-color:'.$cartfile->cover.'">';
            }
            if($card)
            {
                $cartname = $card->title;
            }
            return response()->json(['success'=> $div, 'list'=>$list,'com'=>$com,'labs'=>$labs,'select'=>$select,
             'cover'=>$cover,'descr'=>$descr,'carddate'=>$carddate,'cartname'=>$cartname,'username'=>$username]);
    }

}
