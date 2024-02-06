<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class PaymentGetwayController extends Controller
{
    public function payment(){
        return view('web.payment');
    }
    
    // public function payment()
    // {
    //     $client = new Client();

    //     $response = $client->request('GET', 'https://api.atmaadhaar.com/production/api/getip', [
    //         'headers' => [
    //             'accept' => 'application/json',
    //         ],
    //     ]);

    //     return $response->getBody();
    // }

    public function getWalletBalance()
    {
        $client = new Client();

        $response = $client->request('POST', 'https://api.atmaadhaar.com/production/api/wallet/balance', [
            'body' => '{"partner_id":45}',
            'headers' => [
                'accept' => 'application/json',
                'api-key' => '9SwhvEm5umIndkUgCdCcwtsye7rg6mQ2sD2mgkZq',
                'content-type' => 'application/json',
            ],
        ]);

        return $response->getBody();
    }

 public function createCollectionOrder(Request $request)
    {

// $curl = curl_init();

// $randum =  rand(10000, 999999);
//          $mtraction = $randum;

// curl_setopt_array($curl, [
//   CURLOPT_URL => "https://api.atmaadhaar.com/production/api/payment/order/upi",
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => "",
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 10,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => "POST",
//   CURLOPT_POSTFIELDS => json_encode([
//     'partner_id' => 45,
//     'name' => 'Test',
//     'vpa' => '9999911111@upi',
//     'mobile' => 9999911111,
//     'amount' => 100,
//     'webhook' => 'https://getiq.in/',
//     'latitude' => 23.2323,
//     'longitude' => 23.3232,
//     'apitxnid' => 'Tourn'.$mtraction,
//     'mode' => 'UPI'
//   ]),
//   CURLOPT_HTTPHEADER => [
//     "accept: application/json",
//     "api-key: 9SwhvEm5umIndkUgCdCcwtsye7rg6mQ2sD2mgkZq",
//     "content-type: application/json"
//   ],
// ]);

// $response = curl_exec($curl);
// $err = curl_error($curl);

// curl_close($curl);

// if ($err) {
//   echo "cURL Error #:" . $err;
// } else {
//   echo $response;
// }
        // Create a new Guzzle HTTP client
        $client = new Client();
        
        $randum =  rand(10000, 999999);
         $mtraction = $randum;
         
        $partnerId = '45';
        $parameters = [
            'partner_id' => $partnerId,
            'apitxnid' => 'Tourn'.$mtraction,
            'amount' => '100',
            'callback' => 'https://apiatmaadhaar.readme.io/reference/api-credentials'
        ];

        // Make a POST request to the API endpoint
        $response = $client->request('POST', 'https://api.atmaadhaar.com/production/api/collection/order/create', [
            'body' => json_encode($parameters),
            'headers' => [
                'accept' => 'application/json',
                'api-key' => '9SwhvEm5umIndkUgCdCcwtsye7rg6mQ2sD2mgkZq',
                'content-type' => 'application/json',
            ],
        ]);

        // Decode the response JSON
        $responseData = json_decode($response->getBody(), true);

        // Check if the order creation was successful
        if ($responseData['statuscode'] === 'SUCCESS') {
            // Order creation was successful, redirect to the gateway
            $gatewayUrl = $responseData['https://apiatmaadhaar.readme.io/reference/api-credentials'];
            return redirect()->to($gatewayUrl);
        } else {
            // Handle the case where order creation failed
            return response()->json($responseData, 422);
        }
    }


    public function getCollectionOrderStatus(Request $request)
    {
        $client = new Client();

        $response = $client->request('POST', 'https://api.atmaadhaar.com/production/api/collection/order/status', [
            'body' => json_encode($request->all()),
            'headers' => [
                'accept' => 'application/json',
                'api-key' => '9SwhvEm5umIndkUgCdCcwtsye7rg6mQ2sD2mgkZq',
                'content-type' => 'application/json',
            ],
        ]);

        return $response->getBody();
    }

    public function createPaymentOrder(Request $request)
    {
        $client = new Client();
        
      

        $response = $client->request('POST', 'https://api.atmaadhaar.com/production/api/payment/order/create', [
            'body' => json_encode($request->all()),
            'headers' => [
                'accept' => 'application/json',
                'api-key' => 'bucykpifxahgnnhdhrbxfqbqqzuibaezasdasdadasdas',
                'content-type' => 'application/json',
            ],
        ]);

        return $response->getBody();
    }

    public function getPaymentOrderStatus(Request $request)
    {
        $client = new Client();

        $response = $client->request('POST', 'https://api.atmaadhaar.com/production/api/payment/order/status', [
            'body' => json_encode($request->all()),
            'headers' => [
                'accept' => 'application/json',
                'api-key' => 'bucykpifxahgnnhdhrbxfqbqqzuibaezasdasdadasdas',
                'content-type' => 'application/json',
            ],
        ]);

        return $response->getBody();
    }

   
    
public function createUpiPaymentOrder(Request $request)
{
    $client = new Client();

    $parameters = [
        'partner_id' => '45',
        'mode'       => 'UPI',
        'name'       => 'SRUniversalMart',
        'vpa'        => '99999@upi',
        'mobile'     => '9999911111',
        'amount'     => '0',
        'webhook'    => 'https://api.atmaadhaar.com',
        'latitude'   => '11.2222',
        'longitude'  => '11.2222',
        'apitxnid'   => 'TXN12385',
    ];

    $response = $client->request('POST', 'https://api.atmaadhaar.com/production/api/payment/order/upi', [
        'json' => $parameters,
        'headers' => [
            'accept'       => 'application/json',
            'api-key'      => '9SwhvEm5umIndkUgCdCcwtsye7rg6mQ2sD2mgkZq',
            'content-type' => 'application/json',
        ],
    ]);

    echo $response->getBody();
}
}
