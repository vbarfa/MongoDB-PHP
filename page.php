<?php 

if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    //If required
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
  if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");         
 
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
    exit(0);
}

require_once("connection.php");

$mongoObj = new MongoClass();

$collectionName = 'page';
$documentData = array();

// testing data
//$documentData = array('_id' => 2);


//$document = $mongoObj -> documentSearch($collectionName,$documentData);

$request_method = $_SERVER["REQUEST_METHOD"];
$data = json_decode(file_get_contents("php://input"));


switch($request_method)
{
      case 'GET':
        // Retrive pages
        if(!empty($_GET["pageID"]))
        {
          $pageID = intval($_GET["pageID"]);
          $documentData = array('_id' => (string)$pageID);
        }
        else
        {
          $documentData = array();
        }

        $document = $mongoObj -> documentSearch($collectionName, $documentData);
        echo "<pre>";
        print_r($document);

        break;
      case 'POST':
        // Insert page
        $mongoObj->saveDocument($data);
        break;
      case 'PUT':
        $mongoObj->updateDocument($data);
        break;
      case 'DELETE':
        // Delete User
        $mongoObj->deleteDocument($data);
        break;
      default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
    }


