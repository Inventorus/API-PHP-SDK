

### Class: \Inventorus\APIException

> Class for exceptions when there is a network error, status code error, etc.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>string</em> <strong>$reason</strong>, <em>int</em> <strong>$responseCode</strong>, <em>string</em> <strong>$responseBody</strong>)</strong> : <em>void</em><br /><em>The HTTP response code from the API request</em> |
| public | <strong>getReason()</strong> : <em>string</em><br /><em>The reason for raising an exception</em> |
| public | <strong>getResponseBody()</strong> : <em>mixed</em><br /><em>The HTTP response body from the API request</em> |
| public | <strong>getResponseCode()</strong> : <em>int</em><br /><em>The HTTP response code from the API request</em> |

*This class extends \Exception*

