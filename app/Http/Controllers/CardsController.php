<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Card;
use App\Models\Listing;


class CardsController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }

    public function new ($listing_id)
    {
        return view('card/new', ['listing_id' => $listing_id]);
    }

    // Store cards //
    public function store(Request $request)
    {

        $validator = Validator::make($request->all() , ['card_title' => 'required|max:255',]);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        // return $request->all();
        $cards = new Card;
        $cards->title = $request->card_title;
        $cards->listing_id = $request->list_id;
        $cards->memo = $request->card_memo;
        $cards->save();
        return response()->json('success');

    }

    // Display Card //
    public function show($listing_id, $card_id)
    {
        $listing = Listing::find($listing_id);
        $card = Card::find($card_id);

        return view('card/show', ['listing' => $listing, 'card' => $card]);
    }

    // Edit Cards //
    public function edit($listing_id, $card_id)
    {
        $listings = Listing::where('user_id', Auth::user()->id)->get();
        $listing = Listing::find($listing_id);
        $card = Card::find($card_id);

        return view('card/edit', ['listings' => $listings, 'listing' => $listing, 'card' => $card]);
    }


    // Update Cards //
    public function updatecard(Request $request)
    {

        // return $request->all();
        $card = Card::find($request->cardid);
        $card->title = $request->title;
        $card->save();
        return 1;
    }

    // Delete Cards //
    public function destroy($card_id)
    {
        $card = Card::find($card_id);
        $card->delete();

        return redirect()->route('carts');
    }
}
