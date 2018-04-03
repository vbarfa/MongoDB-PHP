<?php
class MongoClass {

public $connectionString;
public $dataSet;
private $sqlQuery;

private $mongoObj;


protected $databaseName;
// protected $hostName;
//protected $userName;
//protected $passCode;

function __construct()    {
    $this -> connectionString = NULL;
    $this -> sqlQuery = NULL;
    $this -> dataSet = NULL;
    $this -> mongoObj = NULL;

    $databaseName = "mongoDB";
    //$this -> hostName = $dbPara -> serverName;
    //$this -> userName = $dbPara -> userName;
    //$this -> passCode = $dbPara ->passCode;
    //$dbPara = NULL;

    $this -> mongoObj = new MongoClient();
    $this -> connectionString = $this -> mongoObj->$databaseName;
    return $this -> connectionString;
}

function dbDisconnect() {
    $this -> connectionString = NULL;
    $this -> sqlQuery = NULL;
    $this -> dataSet = NULL;
    $this -> databaseName = NULL;
    // $this -> hostName = NULL;
    // $this -> userName = NULL;
    //$this -> passCode = NULL;
}


// collection create 
function collectionCreate($collectionName){
    return $this -> connectionString->createCollection($collectionName);
}


// document insert 
function documentInsert($collectionName, $checkDocument, $documentData){

 $cursor = $this -> connectionString->find($checkDocument);
 
 $checkParameter ='';
 foreach ($cursor as $document) {
    $checkParameter = $document["name"];
  }
  
 if($checkParameter){
      //echo "document allready there";
   } else {
     $document =   $this -> connectionString->$collectionName->insert($documentData);
   }
    return $document;
 
 }


// document update 
function documentUpdate($collectionName, $documentWhere, $documentUpdateData){

    $cursor = $this -> connectionString->find($documentWhere);
    
    $checkParameter ='';
    foreach ($cursor as $document) {
       $checkParameter = $document["name"];
     }
     
    if($checkParameter){
        $document =  $this -> connectionString->$collectionName->update($documentWhere,$documentUpdateData);
      } else {
           echo "document not found";
    } 
       return $document;
    
}

// document find
function documentSearch($collectionName, $documentData){
   
    $cursor = $this -> connectionString->$collectionName->find($documentData);

    foreach ($cursor as $document) {
        $this -> dataSet[] = $document;
     }
     return $this -> dataSet;
 
 }


 // document delete
function documentDelete($collectionName, $documentWhere){
  
    $cursor = $this -> connectionString->$collectionName->find($documentData);

    $checkParameter ='';
    foreach ($cursor as $document) {
       $checkParameter = $document["name"];
     }
     
    if($checkParameter){
        $document =  $this -> connectionString->$collectionName->remove($documentWhere);
      } else {
           echo "document not found";
    } 
       return $document;
 
 }

}