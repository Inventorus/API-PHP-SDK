

### Class: \Inventorus\InventorusClient

> Inventorus client class

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>mixed</em> <strong>$apiKey=null</strong>)</strong> : <em>void</em><br /><em>Constructor with authentication and configuration parameters</em> |
| public | <strong>createExport(</strong><em>\Inventorus\Models\ExportRequest</em> <strong>$body</strong>)</strong> : <em>string</em><br /><em>Creates a new export.</em> |
| public | <strong>createImport(</strong><em>\Inventorus\Models\ImportRequest</em> <strong>$body</strong>)</strong> : <em>string</em><br /><em>Creates a new import.</em> |
| public | <strong>getExport(</strong><em>string</em> <strong>$id</strong>)</strong> : <em>mixed</em><br /><em>Returns export transaction.</em> |
| public | <strong>getExportHistory()</strong> : <em>array</em><br /><em>Returns ids of all export transactions you have created.</em> |
| public | <strong>getHttpCallBack()</strong> : <em>HttpCallBack The HttpCallBack object set for this controller</em><br /><em>Get HttpCallBack for this controller</em> |
| public | <strong>getImport(</strong><em>string</em> <strong>$id</strong>)</strong> : <em>mixed</em><br /><em>Returns import transaction.</em> |
| public | <strong>getImportHistory()</strong> : <em>array</em><br /><em>Returns ids of all import transactions you have created.</em> |
| public | <strong>getItemDetails(</strong><em>string</em> <strong>$id</strong>)</strong> : <em>mixed</em><br /><em>Returns item details.</em> |
| public | <strong>getUsersApps(</strong><em>string</em> <strong>$steamid</strong>, <em>mixed/bool</em> <strong>$includeEmpty=null</strong>)</strong> : <em>array</em><br /><em>Returns applications with inventory items owned by Steam user.</em> |
| public | <strong>getUsersItems(</strong><em>string</em> <strong>$steamid</strong>, <em>\Inventorus\uint</em> <strong>$appid</strong>, <em>mixed/array</em> <strong>$contextids=null</strong>)</strong> : <em>array</em><br /><em>Returns user's items from specific application.</em> |
| public | <strong>listWarehouse()</strong> : <em>array</em><br /><em>Returns all currently owned items.</em> |
| public | <strong>setHttpCallBack(</strong><em>\Inventorus\Http\HttpCallBack</em> <strong>$httpCallBack</strong>)</strong> : <em>void</em><br /><em>Set HttpCallBack for this controller</em> |

