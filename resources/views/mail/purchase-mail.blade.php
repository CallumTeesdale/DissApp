<div>

    <h1>Thanks for your purchase. Here are the details</h1>
    <img style="width:100px; height:100px;"
        src="{{ $message->embed(storage_path().'/app/public/market/'.$marketImage) }}">
    <p>Name: {{ $marketName }}</p>
    <p>Description: {{ $marketDescription }}</p>
    <p>Price: {{ $marketPrice }}</p>
    <p>Scan the barcode below at the retailer</p>
    <div>
        {!! $marketBarcode !!}
    </div>
    <p>{{ $barcodeString}}</p>

</div>
