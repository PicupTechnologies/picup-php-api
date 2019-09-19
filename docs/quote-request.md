# Quote/OneToMany

Used to obtain costing quotes from Picup

# Usage

# Create QuoteRequest

    // build quote basics
    $deliveryQuoteRequest = new DeliveryQuoteRequest();
    $deliveryQuoteRequest->merchant_id = 'merchant-d827f668-d434-4ce5-b853-878f874ae746';
    $deliveryQuoteRequest->customer_ref = 'customer-ref-123';

    $scheduledDate = new DateTime();
    $scheduledDate->add(new DateInterval('PT24H'));
    $deliveryQuoteRequest->scheduled_date = $scheduledDate;

    // build sender
    $senderAddress = new DeliverySenderAddress();
    $senderAddress->warehouse_id = 'warehouse-1d1d8d88-0223-4899-ad2e-5c0c105462fc';

    $senderContact = new DeliverySenderContact();
    $senderContact->name = 'Sender Name';
    $senderContact->email = 'sender@email.com';
    $senderContact->cellphone = '0820001111';
    $senderContact->telephone = '0820001111';
    $specialInstructions = 'Please call sender when at collection point.';

    $deliverySender = new DeliverySender($senderAddress, $senderContact, $specialInstructions);

    // build receiver
    $receiverAddress = new DeliveryReceiverAddress();
    $receiverAddress->street_or_farm = $request['destination']['address1'];
    $receiverAddress->complex = $request['destination']['address2'];
    $receiverAddress->city = $request['destination']['city'];
    $receiverAddress->postal_code = $request['destination']['postal_code'];
    $receiverAddress->country = 'South Africa';

    $receiverContact = new DeliveryReceiverContact();
    $receiverContact->name = $request['destination']['name'] ?? 'Quote Name';
    $receiverContact->cellphone = $request['destination']['phone'] ?? '000 123 4567';

    $specialInstructions = 'None';

    $collection = new DeliveryParcelCollection();

    $parcel = new DeliveryParcel('Order Number', ParcelSizeEnum::ParcelMedium);
    $collection->addParcel($parcel);

    $deliveryReceiver = new DeliveryReceiver(
        $receiverAddress,
        $receiverContact,
        $collection,
        $specialInstructions
    );

    $deliveryQuoteRequest->sender = $deliverySender;
    $deliveryQuoteRequest->receiver = $deliveryReceiver;
    
# Send QuoteRequest

    $deliveryQuoteResponse = $deliveryService->sendQuoteRequest($deliveryQuoteRequest);
