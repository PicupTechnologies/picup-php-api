<?php

namespace PicupTechnologies\PicupPHPApiExamples;

use GuzzleHttp\Client;
use PicupTechnologies\PicupPHPApi\Exceptions\PicupApiException;
use PicupTechnologies\PicupPHPApi\Exceptions\PicupApiKeyInvalid;
use PicupTechnologies\PicupPHPApi\PicupApi;

require_once 'vendor/autoload.php';

try {
    $apiKey = 'business-06fcabf7-66c8-4f7f-a0d1-5035bc32d1ee'; // bryans test
    $client = new Client();

    $api = new PicupApi($client, $apiKey);

    $integration = $api->sendIntegrationDetailsRequest($apiKey);
    print_r($integration);

} catch (PicupApiException $e) {
    echo $e->getMessage();
} catch (PicupApiKeyInvalid $e) {
    echo $e->getMessage();
}
