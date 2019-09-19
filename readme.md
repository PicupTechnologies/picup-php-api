# Picup PHP API

This package provides a PHP API for Picup deliveries. We are currently working against v1 of the Picup API.

## Requirements

* Guzzle HTTP Client

## Supported Endpoints

We are currently supporting:

- /integration/quote/one-to-many
- /integration/create/one-to-one
- /integration/add-to-bucket
- /integration/%s/details
- /integration/%s/dispatch-summary

# General Usage

    $guzzle = new Client();
    $deliveryService = new DeliveryService($guzzle);

# Documentation

## AddToBucket

Creates a bucket with Picup

## Quote OneToMany

This endpoint is used to obtain a costing quote from picup.

