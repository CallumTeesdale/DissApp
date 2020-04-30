<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Market;
use App\Mail\PurchaseReceipt;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use App\ContractInteractions;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\EthEth;
use App\Barcode;
use Illuminate\View\View;
use function array_push;

class MarketController extends Controller
{
<<<<<<< HEAD
    /**
     * @return Factory|View
     */
=======
    //
>>>>>>> parent of dcfb3a9... More phpdocs
    public function index()
    {
        $variables = [];
        $items = Market::all();
        foreach ($items as $item) {
            $barcodes = Barcode::where('market_id', $item->id)->get();
            if (!empty($barcodes)) {
                array_push($variables, $item);
            }
        }


        return view('market.market-view', ['variables' => $variables]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function buyItemPasswordConfirmForm($id)
    {
        $id = $id;
        return view('market.market-password-confirm', ['id' => $id]);
    }

<<<<<<< HEAD
    /**
     * @param Request $request
     * @return Factory|View
     */
=======
>>>>>>> parent of dcfb3a9... More phpdocs
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
                    Mail::to(Auth::user()->email)->send(new PurchaseReceipt($item));
                }
                //@codeCoverageIgnoreStart
                catch (Exception $e) {

                    /**
                     * * Error in the processing of the transfer
                     */
                    $message = 'Error processing purchase, you have not been charged.';
                    return view('generic-message-view', ['message' => $e, 'title' => 'Something went wrong']);
                }
            }
            //@codeCoverageIgnoreStop
            else {

                /**
                 * * Error in validating that the user has enoug funds
                 */
                return view('generic-message-view', ['message' => 'Not enough funds', 'title', 'Something went wrong']);
            }
        }
        //@codeCoverageIgnoreStart
        catch (Exception $e) {

            /**
             * * General error
             */
            return view('generic-message-view', ['message' => $e]);
        }
        //@codeCoverageIgnoreStop
        /**
         * * If all succesful return
         */
        $message = 'Thank you for your purchase. An email has been sent containing the purchase receipt and redemption details';
        return view('generic-message-view', ['message' => $message, 'title' => 'Enjoy!']);
    }
}
