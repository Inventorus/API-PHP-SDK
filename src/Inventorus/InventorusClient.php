<?php
namespace Inventorus;

use Inventorus\APIException;
use Inventorus\APIHelper;
use Inventorus\Configuration;
use Inventorus\Models;
use Inventorus\Http\HttpRequest;
use Inventorus\Http\HttpResponse;
use Inventorus\Http\HttpMethod;
use Inventorus\Http\HttpContext;
use Inventorus\Http\HttpCallBack;
use Unirest\Request;

/**
 * Inventorus client class
 */
class InventorusClient {

    /**
     * HttpCallBack instance associated with this controller
     * @var HttpCallBack
     */
    private $httpCallBack = null;

    /**
     * Constructor with authentication and configuration parameters
     */
    public function __construct($apiKey = NULL)
    {
        Configuration::$apiKey = $apiKey ? $apiKey : Configuration::$apiKey;
    }

    /**
     * Set HttpCallBack for this controller
     * @param HttpCallBack $httpCallBack Http Callbacks called before/after each API call
     */
    public function setHttpCallBack(HttpCallBack $httpCallBack)
    {
        $this->httpCallBack = $httpCallBack;
    }

    /**
     * Get HttpCallBack for this controller
     * @return HttpCallBack The HttpCallBack object set for this controller
     */
    public function getHttpCallBack()
    {
        return $this->httpCallBack;
    }

    /**
     * Returns ids of all export transactions you have created.
     * @return array
     * @throws APIException Thrown if API call fails
     */
    public function getExportHistory ()
    {
        //the base uri for api requests
        $_queryBuilder = Configuration::$BASEURI;

        //prepare query string for API call
        $_queryBuilder = $_queryBuilder.'/warehouse/exports/history';

        //process optional query parameters
        APIHelper::appendUrlWithQueryParameters($_queryBuilder, array (
            'apiKey' => Configuration::$apiKey,
        ));

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl($_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => 'APIMATIC 2.0',
            'Accept'        => 'application/json'
        );

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::GET, $_headers, $_queryUrl);
        if($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::get($_queryUrl, $_headers);

        //call on-after Http callback
        if($this->getHttpCallBack() != null) {
            $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
            $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        if (!isset($response->body->status)) {
          throw new APIException('Unexpected error in API call. See HTTP response body for details.', $response->code, $response->body);
        }
        else if ($response->body->status == 'error') {
          throw new APIException('API responded with error status.', $response->code, $response->body);
        }

        return $response->body->response->data->ids;
    }

    /**
     * Returns user's items from specific application.
     * @param  string     $steamid        Required parameter: SteamID64 of user's profile
     * @param  uint       $appid          Required parameter: ID of target application
     * @param  array      $contextids     Optional parameter: Array containing numbers representing context ids. By default all contexts are included, but it's recommended to achieve better performance and lower costs.
     * @return array
     * @throws APIException Thrown if API call fails
     */
    public function getUsersItems ($steamid, $appid, $contextids = NULL)
    {
        //the base uri for api requests
        $_queryBuilder = Configuration::$BASEURI;

        //prepare query string for API call
        $_queryBuilder = $_queryBuilder.'/steam/items/{steamid}/{appid}';

        //process optional query parameters
        APIHelper::appendUrlWithTemplateParameters($_queryBuilder, array (
            'steamid'    => $steamid,
            'appid'      => $appid,
            ));

        //process optional query parameters
        APIHelper::appendUrlWithQueryParameters($_queryBuilder, array (
            'contextids' => $contextids,
            'apiKey' => Configuration::$apiKey,
        ));

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl($_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => 'APIMATIC 2.0',
            'Accept'        => 'application/json'
        );

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::GET, $_headers, $_queryUrl);
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::get($_queryUrl, $_headers);

        //call on-after Http callback
        if($this->getHttpCallBack() != null) {
            $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
            $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        if (!isset($response->body->status)) {
          throw new APIException('Unexpected error in API call. See HTTP response body for details.', $response->code, $response->body);
        }
        else if ($response->body->status == 'error') {
          throw new APIException('API responded with error status.', $response->code, $response->body);
        }

        return array(
          $response->body->response->data->inventory,
          $response->body->response->data->currency
        );
    }

    /**
     * Returns applications with inventory items owned by Steam user.
     * @param  string     $steamid          Required parameter: SteamID64 of user's profile
     * @param  bool       $includeEmpty     Optional parameter: Include user's apps currently containing no items inside his inventory. Default is set to false.
     * @return array
     * @throws APIException Thrown if API call fails
     */
    public function getUsersApps ($steamid, $includeEmpty = NULL)
    {
        //the base uri for api requests
        $_queryBuilder = Configuration::$BASEURI;

        //prepare query string for API call
        $_queryBuilder = $_queryBuilder.'/steam/apps/{steamid}';

        //process optional query parameters
        APIHelper::appendUrlWithTemplateParameters($_queryBuilder, array (
            'steamid'      => $steamid,
            ));

        //process optional query parameters
        APIHelper::appendUrlWithQueryParameters($_queryBuilder, array (
            'includeEmpty' => var_export($includeEmpty, true),
            'apiKey' => Configuration::$apiKey,
        ));

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl($_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => 'APIMATIC 2.0',
            'Accept'        => 'application/json'
        );

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::GET, $_headers, $_queryUrl);
        if($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::get($_queryUrl, $_headers);

        //call on-after Http callback
        if($this->getHttpCallBack() != null) {
            $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
            $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        if (!isset($response->body->status)) {
          throw new APIException('Unexpected error in API call. See HTTP response body for details.', $response->code, $response->body);
        }
        else if ($response->body->status == 'error') {
          throw new APIException('API responded with error status.', $response->code, $response->body);
        }

        return $response->body->response->data->apps;
    }

    /**
     * Returns export transaction.
     * @param  string     $id         Required parameter: ID of requested Import transaction
     * @return mixed
     * @throws APIException Thrown if API call fails
     */
    public function getExport ($id)
    {
        //the base uri for api requests
        $_queryBuilder = Configuration::$BASEURI;

        //prepare query string for API call
        $_queryBuilder = $_queryBuilder.'/warehouse/exports/{id}';

        //process optional query parameters
        APIHelper::appendUrlWithTemplateParameters($_queryBuilder, array (
            'id'     => $id,
            ));

        //process optional query parameters
        APIHelper::appendUrlWithQueryParameters($_queryBuilder, array (
            'apiKey' => Configuration::$apiKey,
        ));

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl($_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => 'APIMATIC 2.0',
            'Accept'        => 'application/json'
        );

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::GET, $_headers, $_queryUrl);
        if($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::get($_queryUrl, $_headers);

        //call on-after Http callback
        if($this->getHttpCallBack() != null) {
            $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
            $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        if (!isset($response->body->status)) {
          throw new APIException('Unexpected error in API call. See HTTP response body for details.', $response->code, $response->body);
        }
        else if ($response->body->status == 'error') {
          throw new APIException('API responded with error status.', $response->code, $response->body);
        }

        return $response->body->response->data->export;
    }

    /**
     * Creates a new export.
     * @param  Models\ExportRequest $body       Required parameter
     * @return string
     * @throws APIException Thrown if API call fails
     */
    public function createExport ($body)
    {
        //the base uri for api requests
        $_queryBuilder = Configuration::$BASEURI;

        //prepare query string for API call
        $_queryBuilder = $_queryBuilder.'/warehouse/exports';

        //process optional query parameters
        APIHelper::appendUrlWithQueryParameters($_queryBuilder, array (
            'apiKey' => Configuration::$apiKey,
        ));

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl($_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => 'APIMATIC 2.0',
            'Accept'        => 'application/json',
            'content-type'  => 'application/json; charset=utf-8'
        );

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::POST, $_headers, $_queryUrl);
        if($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::post($_queryUrl, $_headers, Request\Body::Json($body));

        //call on-after Http callback
        if($this->getHttpCallBack() != null) {
            $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
            $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        if (!isset($response->body->status)) {
          throw new APIException('Unexpected error in API call. See HTTP response body for details.', $response->code, $response->body);
        }
        else if ($response->body->status == 'error') {
          throw new APIException('API responded with error status.', $response->code, $response->body);
        }

        return $response->body->response->data->id;
    }

    /**
     * Returns ids of all import transactions you have created.
     * @return array
     * @throws APIException Thrown if API call fails
     */
    public function getImportHistory ()
    {
        //the base uri for api requests
        $_queryBuilder = Configuration::$BASEURI;

        //prepare query string for API call
        $_queryBuilder = $_queryBuilder.'/warehouse/imports/history';

        //process optional query parameters
        APIHelper::appendUrlWithQueryParameters($_queryBuilder, array (
            'apiKey' => Configuration::$apiKey,
        ));

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl($_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => 'APIMATIC 2.0',
            'Accept'        => 'application/json'
        );

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::GET, $_headers, $_queryUrl);
        if($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::get($_queryUrl, $_headers);

        //call on-after Http callback
        if($this->getHttpCallBack() != null) {
            $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
            $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        if (!isset($response->body->status)) {
          throw new APIException('Unexpected error in API call. See HTTP response body for details.', $response->code, $response->body);
        }
        else if ($response->body->status == 'error') {
          throw new APIException('API responded with error status.', $response->code, $response->body);
        }

        return $response->body->response->data->ids;
    }

    /**
     * Returns import transaction.
     * @param  string     $id         Required parameter: ID of requested Import transaction
     * @return mixed
     * @throws APIException Thrown if API call fails
     */
    public function getImport ($id)
    {
        //the base uri for api requests
        $_queryBuilder = Configuration::$BASEURI;

        //prepare query string for API call
        $_queryBuilder = $_queryBuilder.'/warehouse/imports/{id}';

        //process optional query parameters
        APIHelper::appendUrlWithTemplateParameters($_queryBuilder, array (
            'id'     => $id,
            ));

        //process optional query parameters
        APIHelper::appendUrlWithQueryParameters($_queryBuilder, array (
            'apiKey' => Configuration::$apiKey,
        ));

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl($_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => 'APIMATIC 2.0',
            'Accept'        => 'application/json'
        );

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::GET, $_headers, $_queryUrl);
        if($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::get($_queryUrl, $_headers);

        //call on-after Http callback
        if($this->getHttpCallBack() != null) {
            $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
            $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        if (!isset($response->body->status)) {
          throw new APIException('Unexpected error in API call. See HTTP response body for details.', $response->code, $response->body);
        }
        else if ($response->body->status == 'error') {
          throw new APIException('API responded with error status.', $response->code, $response->body);
        }

        return $response->body->response->data->import;
    }

    /**
     * Returns all currently owned items.
     * @return array
     * @throws APIException Thrown if API call fails
     */
    public function listWarehouse ()
    {
        //the base uri for api requests
        $_queryBuilder = Configuration::$BASEURI;

        //prepare query string for API call
        $_queryBuilder = $_queryBuilder.'/warehouse';

        //process optional query parameters
        APIHelper::appendUrlWithQueryParameters($_queryBuilder, array (
            'apiKey' => Configuration::$apiKey,
        ));

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl($_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => 'APIMATIC 2.0',
            'Accept'        => 'application/json'
        );

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::GET, $_headers, $_queryUrl);
        if($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::get($_queryUrl, $_headers);

        //call on-after Http callback
        if($this->getHttpCallBack() != null) {
            $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
            $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        if (!isset($response->body->status)) {
          throw new APIException('Unexpected error in API call. See HTTP response body for details.', $response->code, $response->body);
        }
        else if ($response->body->status == 'error') {
          throw new APIException('API responded with error status.', $response->code, $response->body);
        }

        return $response->body->response->data->items;
    }

    /**
     * Creates a new import.
     * @param  Models\ImportRequest $body       Required parameter
     * @return string
     * @throws APIException Thrown if API call fails
     */
    public function createImport ($body)
    {
        //the base uri for api requests
        $_queryBuilder = Configuration::$BASEURI;

        //prepare query string for API call
        $_queryBuilder = $_queryBuilder.'/warehouse/imports';

        //process optional query parameters
        APIHelper::appendUrlWithQueryParameters($_queryBuilder, array (
            'apiKey' => Configuration::$apiKey,
        ));

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl($_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => 'APIMATIC 2.0',
            'Accept'        => 'application/json',
            'content-type'  => 'application/json; charset=utf-8'
        );

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::POST, $_headers, $_queryUrl);
        if($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        printf('%s', json_encode(Request\Body::Json($body)));

        //and invoke the API call request to fetch the response
        $response = Request::post($_queryUrl, $_headers, Request\Body::Json($body));

        //call on-after Http callback
        if($this->getHttpCallBack() != null) {
            $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
            $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        if (!isset($response->body->status)) {
          throw new APIException('Unexpected error in API call. See HTTP response body for details.', $response->code, $response->body);
        }
        else if ($response->body->status == 'error') {
          throw new APIException('API responded with error status.', $response->code, $response->body);
        }

        return $response->body->response->data->id;
    }

    /**
     * Returns item details.
     * @param  string     $id         Required parameter: ID of requested item
     * @return mixed
     * @throws APIException Thrown if API call fails
     */
    public function getItemDetails ($id)
    {
        //the base uri for api requests
        $_queryBuilder = Configuration::$BASEURI;

        //prepare query string for API call
        $_queryBuilder = $_queryBuilder.'/warehouse/items/{id}';

        //process optional query parameters
        APIHelper::appendUrlWithTemplateParameters($_queryBuilder, array (
            'id'     => $id,
            ));

        //process optional query parameters
        APIHelper::appendUrlWithQueryParameters($_queryBuilder, array (
            'apiKey' => Configuration::$apiKey,
        ));

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl($_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => 'APIMATIC 2.0',
            'Accept'        => 'application/json'
        );

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::GET, $_headers, $_queryUrl);
        if($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::get($_queryUrl, $_headers);

        //call on-after Http callback
        if($this->getHttpCallBack() != null) {
            $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
            $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        if (!isset($response->body->status)) {
          throw new APIException('Unexpected error in API call. See HTTP response body for details.', $response->code, $response->body);
        }
        else if ($response->body->status == 'error') {
          throw new APIException('API responded with error status.', $response->code, $response->body);
        }

        return $response->body->response->data->item;
    }
}
