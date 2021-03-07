<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Library\SslCommerz\SslCommerzNotification;

class PaymentController extends Controller
{
    protected $createURL;
    protected $executeURL;
    protected $tokenURL;
    protected $app_key;
    protected $app_secret;
    protected $username;
    protected $password;

    public function __construct()
    {
        $this->createURL = env('B_CREATE_URL');
        $this->executeURL = env('B_EXECUTE_URL');
        $this->tokenURL = env('B_TOKEN_URL');
        $this->app_key = env('B_APP_KEY');
        $this->app_secret = env('B_APP_SECRET');
        $this->username = env('B_USERNAME');
        $this->password = env('B_PASSWORD');
    }
    public function token(Request $request)
    {

        $createpaybody = array('amount' => $request->amount, 'currency' => 'BDT', 'merchantInvoiceNumber' => $request->custorderid, 'intent' => 'sale');
        $url = curl_init('https:\/\/checkout.sandbox.bka.sh\/v1.2.0-beta\/checkout\/payment\/create');

        $createpaybodyx = json_encode($createpaybody);

        $header = array(
            'Content-Type:application/json',
            'authorization:""',
            'x-app-key:"'
        );

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_POSTFIELDS, $createpaybodyx);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        //curl_setopt($url, CURLOPT_PROXY, $proxy);

        $resultdata = curl_exec($url);
        curl_close($url);
        // return $resultdata;

        return response(['paymentID' => '65sfdsdf']);
    }
    /**
     * Token creation for accessing bKash payment APIs.
     *
     * @param int $order_id
     *
     * @return string
     */
    public function get_bkash_token($order_id = '')
    {
        if ($token = isset($_COOKIE['bk_token'])) {
            return $token;
        }

        $data = [
            'app_key'    => $this->app_key,
            'app_secret' => $this->app_secret,
        ];

        $username = $this->username;
        $password = $this->password;

        $headers = [
            'username'     => $username,
            'password'     => $password,
            'Content-Type' => 'application/json',
        ];

        $api_response = $this->create_requrest($this->tokenURL, $data, $headers);

        if (empty($api_response)) {
            return false;
        }

        $response = json_decode($api_response, true);

        if (isset($response['id_token']) && isset($response['token_type'])) {
            $token = $response['id_token'];
            setcookie('bk_token', $token, time() + $response['expires_in']);
            return $token;
        }

        return false;
    }


    /**
     * This API will receive a payment creation request with necessary information.
     *
     * @param string $invoice
     * @param int    $amount
     * @param int    $order_id
     *
     * @return mixed|string
     */
    public function create_bkash_payment($invoice, $amount, $order_id = '')
    {

        $token = $this->get_bkash_token($order_id);

        $app_key = $this->app_key;
        $intent  = 'sale';
        $data    = [
            'amount'                => $amount,
            'currency'              => 'BDT',
            'merchantInvoiceNumber' => $invoice,
            'intent'                => $intent,
        ];

        $headers = [
            'Content-Type'  => 'application/json',
            'authorization' => $token,
            'x-app-key'     => $app_key,
        ];

        $api_response = $this->create_requrest($this->createURL, $data, $headers);

        return $api_response;
    }

    /**
     * This API will finalize a payment request.
     *
     * @param string $paymentid
     * @param int    $order_id
     *
     * @return mixed|string
     */
    public function execute_bkash_payment($paymentid, $order_id = '')
    {

        $paymentID  = $paymentid;
        $token      = $this->get_bkash_token($order_id);
        $app_key    = $this->app_key;
        $executeURL = $this->executeURL . $paymentID;

        $headers = [
            'Content-Type'  => 'application/json',
            'authorization' => $token,
            'x-app-key'     => $app_key,
        ];

        $api_response = $this->create_requrest($executeURL, false, $headers);

        return $api_response;
    }

    /**
     * Create request with WordPress core functions
     *
     * @param $url
     * @param array|boolean $data
     * @param array         $headers
     */
    public function create_requrest($url, $data = false, $headers = [])
    {

        $args = [
            'method'      => 'POST',
            'timeout'     => 60,
            'redirection' => 5,
            'httpversion' => '1.0',
            'blocking'    => true,
            'headers'     => $headers,
        ];

        if (false !== $data) {
            $args['body'] = json_encode($data);
        }

        // $response = wp_remote_post(esc_url_raw($url), $args);

        // if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) == 200) {
        //     /*
        // 	 Will result in $api_response being an array of data,
        // 	parsed from the JSON response of the API listed above */
        //     $api_response = wp_remote_retrieve_body($response);
        //     return $api_response;
        // }

        return false;
    }
}
