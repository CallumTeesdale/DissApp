<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Barcode;
use App\Market;
use \Milon\Barcode\DNS2D;

class PurchaseReceipt extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var market
     */
    public $market;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Market $market)
    {
        //
        $this->market = $market;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $barcode = Barcode::where('item_id', $this->market->id)->get()->first();
        $html = DNS2D::getBarcodeHTML($barcode->barcode, "QRCODE");
        $barcodeDelete = $barcode->delete();
        return $this->view('mail.purchase-mail')
            ->with([
                'marketName' => $this->market->name,
                'marketDescription' => $this->market->description,
                'marketPrice' => $this->market->price,
                'marketImage' => $this->market->image,
                'marketBarcode' => $html,
                'barcodeString' => $barcode->barcode

            ]);
    }
}