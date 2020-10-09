<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Listing;
use App\Cartpop;
use App\Card;
use App\Models\User;


// use Validator;

class ListingController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }

    // Display all Data //
    public function index(Request $request)
    {

        $listings = Listing::with('cards')->where('user_id',Auth::user()->id)->orderBy('created_at','asc')->get();
        $carts = Card::get();
        $files = Cartpop::where('card_id',24)->get();
        $user = User::get();
        return view('listing/index',['listings'=>$listings ,'files'=>$files,'carts'=>$carts, 'user'=>$user]);
    }

    // create Boards //
    public function board()
    {
        $listinghome = Listing::where('user_id',Auth::user()->id)->get();
        return view('listing/board',['listinghome'=>$listinghome]);
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
        $listing->title = $request->list_name;

        $listing->user_id = Auth::user()->id;
        $listing->save();
        return redirect()->route('carts');
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

        $listing = Listing::find($request->id);
        $listing->title = $request->list_name;
        $listing->save();
        return redirect()->route('carts');
    }

    // Delete Listing //
    public function destroy($listing_id)
    {
        $listing = Listing::find($listing_id);
        $listing->delete();
        return redirect()->route('carts');
    }

    // Store Data //
    public function storedata(Request $request)
    {

        // return $request->all();
        $file= new Cartpop();
        $file->description = $request->show;
        $file->comment     = $request->comment;
        $file->checklist   = $request->checklist;
        $file->label       = $request->label;
        $file->card_id     = $request->id;
        $file->date        = $request->start;
        $file->save();
        return 123;
    }



    // Store Files //
    public function storefiles(Request $request)
    {

        // return $request->all();
        $files = new Cartpop();
        $files->card_id = $request->cart_id;

            $image = $request->file('select_file');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('files'), $new_name);
            $files->select_file = $new_name;
            $files->save();

            return response()->json([
            'message'   => 'Image Upload Successfully',
            'uploaded_image' => '<img src="/images/'.$new_name.'" class="img-thumbnail" width="300" />',
            'class_name'  => 'alert-success'
        ]);
    }

    public function deletefiles($id){

    return  $listing = Cartpop::find($id);
        $listing->delete();
        return redirect()->route('carts');
    }

}
