<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Market;
use App\ContractInteractions;
use Exception;
use Illuminate\Support\Facades\Auth;

class MarketController extends Controller
{
  //
  public function index()
  {
    $variables = Market::all();
    return view('market-view', ['variables' => $variables]);
  }
  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function buyItemPasswordConfirmForm($id)
  {
    $id = $id;
    return view('market-password-confirm', ['id' => $id]);
  }

  public function buyItem(Request $request)
  {
    include '../app/ContractVariables.php';
    $itemId = $request->input('id');
    $password = $request->input('password');
    $item = Market::where('id', $itemId)
      ->get()
      ->first();
    try {
      $contract = new ContractInteractions();
      $contract->transfer(
        $contractOwner,
        Auth::user()->public_key,
        $password,
        $item->price
      );
      return redirect('profile');
    } catch (Exception $e) {
      return view('generic-message-view', ['message' => $e]);
    }
  }
}