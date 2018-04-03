<?php 

require_once("connection.php");

$mongoObj = new MongoClass();

$collectionName = 'user';
$documentData = array();

// testing data
//$documentData = array('_id' => 2);

//create collection name
$document = $mongoObj -> collectionCreate($collectionName);

$request_method = $_SERVER["REQUEST_METHOD"];
//$data = json_decode(file_get_contents("php://input"));


switch($request_method)
{
      case 'GET':
        // Retrive pages
        if(!empty($_GET["name"]))
        {
         // $ID = intval($_GET["ID"]);
          $documentData = array("name"=>$_GET["name"]);
        }
        else
        {
          $documentData = array();
        }

        $document = $mongoObj -> documentSearch($collectionName, $documentData);
        //echo "<pre>";
        //print_r($document);

        break;
      case 'POST':
        // Insert page
        $checkDocument = array('name' => "vijay"); // testing data
        $documentData = array("name"=>"vijay", "url" => "www.xyz.com"); // testing data
        $mongoObj->documentInsert($collectionName, $checkDocument, $documentData);
        break;
      case 'PUT':
        $documentWhere = array('name' => "vijay"); // testing data
        $documentData = array("url" => "www.google.com"); // testing data
        $mongoObj->documentUpdate($collectionName,$documentWhere, $documentUpdateData);
        break;
      case 'DELETE':
        // Delete User
        $documentWhere = array('name' => "vijay"); // testing data
        $mongoObj->documentDelete($collectionName, $documentWhere);
        break;
      default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
    }


