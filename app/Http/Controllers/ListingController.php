<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use App\Listing;
use App\Cartpop;
use App\Card;
use App\Models\User;
use Illuminate\Support\Facades\Carbon;
use App\Models\Board;


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

        $lists = Board::where('id',$id)->first();
        $listings = Listing::with('board')->where('user_id',Auth::user()->id)->where('board_id',$id)->orderBy('created_at','asc')->get();
        $carts = Card::get();
        $user = User::get();
        return view('listing/index',compact('listings','carts','user','lists'));
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

        $listing = Listing::find($request->id);
        $listing->title = $request->list_name;
        $listing->save();
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

        // return $request->all();
        $file= new Cartpop();
        $file->description = $request->show;
        $file->comment     = $request->comment;
        $file->checklist   = $request->textInput;
        $file->label       = $request->label;
        $file->date        = $request->start;
        $file->card_id     = $request->id;
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

        $listing = Cartpop::find($id);
        $listing->delete();
        return redirect()->back();
    }

    public function getmodel(Request $request)
    {

        $cartfile = Cartpop::where('card_id',$request->cilckid)->get();

        // foreach($cartfile as $file)
        // {
        //  return   $filess = $file->label;
        // }
       $div =    '';
       $di = '';
       foreach($cartfile as $file){
            if($file->label == ''){

            }else{
                  $div.='<span class="labels">'.$file->label.'</span>';
                  $di.='<span class="labels">'.$file->label.'</span>';
            }
        }

       $date = '';
       foreach($cartfile as $file)
       {
            if($file->date == ''){

            }else{
                $date .= '<input class="form-check-input" type="checkbox" name="checkbox" id="default">
                <span class="date">'.date('d F Y', strtotime(@$file->date)).'</span>';
           }
        }

       $descr = '';
       $comment = '';
       foreach($cartfile as $file)
       {
            if($file->comment == '' && $file->description == '') {

            }else{
                $descr =   @$file->description;
                $comment = @$file->comment;
                $labe =    @$file->label;
            }
        }
       $img ='';
        foreach($cartfile as $file)
        {
            if($file->select_file == '') {

            }else{
                $img .= '<img src="'.asset('files/'.@$file->select_file).'" class="img-fluid  lazyload product-img">
                         <a class="button-link" data-toggle="modal" data-target="#deletedoc" value="Delete" title="Members">Delete</a>';
            }
        }


       $checklist = '';
        foreach($cartfile as $file){
        if($file->checklist == '') {

        }else
        {
            $checklist .= '<input class="form-check-input" type="checkbox" name="checkbox" id="defaultCheck1">
                <span id="checklist">'.@$file->checklist.'</span>
                <label class="form-check-label" for="defaultCheck1"></label><br />';
        }
        }
        return response()->json(['success'=>$div,'date'=>$date,'descr'=>$descr,'img'=>$img,'checklist'=>$checklist,'comment'=>$comment,'di'=>$di]);

    }
}
