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
        /**
         * * Set the contract owner
         */
        $contractOwner = '0x90F8bf6A479f320ead074411a4B0e7944Ea8c9C1';

        /**
         * * Create a new EthEth objec, which allows for transferring of ether
         */
        $eth = new EthEth();
        $itemId = $request->input('id');
        $password = $request->input('password');

        /*
        * Ge the market item
        */
        $item = Market::where('id', $itemId)
            ->get()
            ->first();


        try {

            /**
             * * Create a new contract object to interact with the contract
             */
            $contract = new ContractInteractions();

            /**
             * * Verify the user has enough in their wallet
             */
            $balance = $contract->contractGetBalance(Auth::user()->public_key);
            if ($balance[0]->value >= $item->price) {

                /**
                 * * Transfer enough ether to cover the cost of the contract function
                 */
                $transfer = $eth->transEther(Auth::user()->public_key);

                /**
                 * * Transfer the cost of the item
                 */
                try {
                    $contract->transfer(
                        $contractOwner,
                        Auth::user()->public_key,
                        $password,
                        $item->price
                    );
                } catch (Exception $e) {

                    /**
                     * * Error in the processing of the transfer
                     */
                    $message = 'Error processing purchase, you have not been charged.';
                    return view('generic-message-view', ['message' => $message, 'title' => 'Something went wrong']);
                }
            } else {

                /**
                 * * Error in validating that the user has enoug funds
                 */
                return view('generic-message-view', ['message' => 'Not enough funds', 'title', 'Something went wrong']);
            }
        } catch (Exception $e) {

            /**
             * * General error
             */
            return view('generic-message-view', ['message' => $e]);
        }
        /**
         * * If all succesful return
         */
        $message = 'Thank you for your purchase.';
        return view('generic-message-view', ['message' => $message, 'title' => 'Enjoy!']);
    }
}