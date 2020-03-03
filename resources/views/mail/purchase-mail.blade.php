<div>
    <h1>Thanks for your purchase. Here are the details</h1>
    <p>Name: {{ $marketName }}</p>
    <p>Description: {{ $marketDescription }}</p>
    <p>Price: {{ $marketPrice }}</p>
    <p>Scan the barcode below at the retailer</p>
    <div>
        {!! $marketBarcode !!}
    </div>
    <p>{{ $barcodeString}}</p>

</div>
