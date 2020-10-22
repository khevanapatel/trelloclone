<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Listing;
use App\Models\Cartpop;
use App\Models\Card;
use App\Models\User;
use App\Models\Board;
use App\Models\Checktitle;
Use App\Models\Comment;
use App\Models\label;
use App\Models\Files;
use Input;


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
        $label = label::get();
        $carts = Card::get();
        $user = User::get();
        $comment = Comment::get();
        $file = Files::get();
        $lists = Board::where('id',$id)->first();
        $check = Checktitle::with('checklist')->get();
        $listings = Listing::with('board')->where('user_id',Auth::user()->id)->where('board_id',$id)->orderBy('created_at','asc')->get();
        return view('listing/index',compact('listings','carts','user','lists','check','comment','label','file'));
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
        return $request->all();
        $validator = Validator::make($request->all(),['list_name'=>'required|max:255']);

        if ($validator->fails()){
            return redirect()->back()->withErros($validator->errors())->withInput();
        }

        $listing = Listing::find($request->id);
        $listing->title = $request->list_name;
        $listing->update();
        return redirect()->back();
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
            $file->comment     = $request->comment;
            $file->checklist   = $request->textInput;
            $file->label       = $request->label;
            $file->date        = $request->start;
            $file->card_id     = $request->id;
            $file->save();
            return 'added';

        }
        else
        {
            if($request->show != null)
            {
                $cart->description = $request->show;
            }
            if($request->comment != null)
            {
                $cart->comment = $request->comment;
            }
            if($request->textInput != null)
            {
                $cart->checklist = $request->textInput;
            }
            if($request->label != null)
            {
                $cart->label = $request->label;
            }
            if($request->start != null)
            {
                $cart->date = $request->start;
            }
            if($request->start != null)
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
    public function getmodel(Request $request)
    {
        // return $request->all();
        // return $request->cilckid;
        $cartfile = Cartpop::where('card_id',$request->cilckid)->first();
        $checktitle = Checktitle::with('checklist')->where('cart_id',$request->cilckid)->get();

        if($cartfile && $checktitle)
        {
            $descr   = $cartfile->description;
            $carddate = $cartfile->date;

            return response()->json(['success'=>$descr,'carddate'=>$carddate,'descr'=>$descr,'checktitle'=>$checktitle]);
        }

    }
    public function getchecklist(Request $request)
    {
        $checktitle = Checktitle::with('checklist')->where('cart_id',$request->cilckid)->get();
        view('listing/model',compact('checktitle'));

    }

}
