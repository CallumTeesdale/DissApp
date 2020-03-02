<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Market;
use App\ContractInteractions;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\EthEth;

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
        $contractOwner = '0x90F8bf6A479f320ead074411a4B0e7944Ea8c9C1';
        $eth = new EthEth();
        $itemId = $request->input('id');
        $password = $request->input('password');
        $item = Market::where('id', $itemId)
            ->get()
            ->first();
        try {

            $contract = new ContractInteractions();
            $balance = $contract->contractGetBalance(Auth::user()->public_key);
            if ($balance[0]->value >= $item->price) {
                //transfer enough gas ether
                $transfer = $eth->transEther(Auth::user()->public_key);
                try {
                    $contract->transfer(
                        $contractOwner,
                        Auth::user()->public_key,
                        $password,
                        $item->price
                    );
                } catch (Exception $e) {
                    $message = 'Error processing purchase, you have not been charged.';
                    return view('generic-message-view', ['message' => $message, 'title' => 'Something went wrong']);
                }
            } else {
                return view('generic-message-view', ['message' => 'Not enough funds', 'title', 'Something went wrong']);
            }
        } catch (Exception $e) {
            return view('generic-message-view', ['message' => $e]);
        }
        $message = 'Thank you for your purchase.';
        return view('generic-message-view', ['message' => $message, 'title' => 'Enjoy!']);
    }
}