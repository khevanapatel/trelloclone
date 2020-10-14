<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Card;
use App\Listing;


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

        $validator = Validator::make($request->all() , ['card_title' => 'required|max:255', 'card_memo' => 'required|max:255',]);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $cards = new Card;
        $cards->title = $request->card_title;
        $cards->listing_id = $request->listing_id;
        $cards->memo = $request->card_memo;

        $cards->save();
        return redirect()->back();
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
    public function update(Request $request)
    {

        $validator = Validator::make($request->all() , ['card_title' => 'required|max:255', 'card_memo' => 'required|max:255',]);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $card = Card::find($request->id);
        $card->title = $request->card_title;
        $card->memo = $request->card_memo;
        $card->listing_id = $request->listing_id;
        $card->save();
        return redirect()->back();
    }

    // Delete Cards //
    public function destroy($listing_id, $card_id)
    {
        $card = Card::find($card_id);
        $card->delete();

        return redirect()->route('carts');
    }
}
