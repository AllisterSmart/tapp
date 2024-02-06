<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Location;
use App\Models\Banner;
use App\Models\Games;
use App\Models\Players;
use App\Models\Tournaments;
use Illuminate\Support\Str;

use Carbon\Carbon;

class HomeController extends Controller
    
{
   function index(Request $id){

    $events = Location::all();
    $randomNumber = random_int(100000, 999999);
    $banners = Banner::all();
    $games = Games::all();
    $tournaments = Tournaments::orderBy('updated_at', 'desc')->get();
    return view ('web.web' ,compact('events','randomNumber','banners','games','tournaments'));
   }
   
   
public function pricelist($id)
{
    $tournament = Tournaments::find($id);
    $players = Players::all();
    return view('web.players.pricelist', compact('tournament','players'));
}

public function playerlist($id)
{
    $tournaments = Tournaments::find($id);
    $players = Players::all();
    return view('web.players.playerlist', compact('tournaments','players'));
}

public function tournament($id)
{
     $game = Games::find($id);
        if (!$game) {
            abort(404, 'Game not found');
        }
        $tournament = $game->Tournaments ?? null;
    return view('web.tournament.tournament', compact('tournament','game'));
}
   
  public function deductBalance(Request $request)
{
    if (Auth::check()) {
        $user = Auth::user();

        $fee = $request->input('fee');

        if ($user->add_blance >= $fee) {
            // Deduct the balance
            $user->add_blance -= $fee;
            $user->save();

            return response()->json(['success' => true, 'message' => 'Balance deducted successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Insufficient Balance']);
        }
    } else {
        return response()->json(['success' => false, 'message' => 'User not authenticated']);
    }
}

   

   

   function profile(){
       return view('web.userprofile');
   }
   function settings(){
       return view('dashboards.users.settings');
   }
   
   function wallet(){
       return view('web.wallet');
   }
   
   public function payment($id)
    {
        $user_data = DB::table('tournaments')->where('id', $id)->first();

        if (!$user_data) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return view('web.payment', compact('user_data'));
    }

}