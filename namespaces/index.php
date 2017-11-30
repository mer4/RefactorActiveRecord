<?php

//turn on debugging messages
ini_set('display_errors', 'On');
error_reporting(E_ALL);

//Database information
define('DATABASE', 'mer4');
define('USERNAME', 'mer4');
define('PASSWORD', '2kXQOxHZC');
define('CONNECTION', 'sql2.njit.edu');

//Autuloader class
class Manage {
    public static function autoload($class) {
        echo $class . '<br>'; 
	$path = 'classes/' .  str_replace('\\', '/', $class). '.php';
        echo $path . '<br>';
	include $path;
    }
}
spl_autoload_register(array('Manage', 'autoload'));
/*
include 'model.php';
include 'collection.php';
include "account.php";
include "todos.php";
include "todo.php";
include 'accounts.php';
include "htmlTable.php";
include 'dbConn.php';

*/
//instantiate the main object
$obj = new main();

class main
{

    public function __construct()
    {
        //printing all function outputs

        $form = '<form method="post" enctype="multipart/form-data">';
        $form .= '<h1>Table: Accounts</h1>';

        //select all records
        $form .= '<h2>Select All Records</h2>';
        $records = accounts::findAll();
	$tableGen = htmlTable::genarateTableFromMultiArray($records);
        $form .= $tableGen;

        //select one record
        $form .= '<h2>Select One Record</h2>';
        $id=2;
        $records = accounts::findOne($id);
        $tableGen = htmlTable::generateTableFromOneRecord($records);
        $form .= '<h3>Record retrieved with id: '.$id.'</h3>';
        $form .= $tableGen;

        //insert one record
        $form .= '<h2>Insert One Record</h2>';
        $record = new account();
        $record->email="sd39@njit.edu";
        $record->fname="test";
        $record->lname="cccc";
        $record->phone="4444";
        $record->birthday="00-00-0000";
        $record->gender="male";
        $record->password="12345";
        $lastInsertedId=$record->save();
        $records =accounts::findAll();
        $tableGen = htmlTable::genarateTableFromMultiArray($records);
        $form .= '<h3>After Inserting</h3>';
        $form .= $tableGen;

        //update one record
        $form .= '<h2>Update One Record</h2>';
        $records = accounts::findOne($lastInsertedId);
        $record = new account();
        $record->id=$records->id;
        $record->lname="yyyy";
        $record->gender="yyyy";
        $record->save();
        $form .= '<h3>Record update with id: '.$records->id.'</h3>';
        $records = accounts::findAll();
        $tableGen = htmlTable::genarateTableFromMultiArray($records);
        $form .= $tableGen;

        //delete one record
        $form .= '<h2>Delete One Record</h2>';
        $records = accounts::findOne($lastInsertedId);
        $record= new account();
        $record->id=$records->id;
        $record->delete();
        $form .= '<h3>Record with id: '.$records->id.' is deleted</h3>';
        $form .= '<h3>After Delete</h3>';
        $records = accounts::findAll();
        $tableGen = htmlTable::genarateTableFromMultiArray($records);
        $form .= $tableGen;

        $form .= '<h1>Table: Todos</h1>';

        //select all records
        $form .= '<h2>Select All Records</h2>';
        $records = todos::findAll();
        $tableGen = htmlTable::genarateTableFromMultiArray($records);
        $form .= $tableGen;

        //select one record
        $form .= '<h2>Select One Record</h2>';
        $id=2;
        $records = todos::findOne($id);
        $tableGen = htmlTable::generateTableFromOneRecord($records);
        $form .= '<h3>Record retrieved with id: '.$id.'</h3>';
        $form .= $tableGen;

        //insert one record
        $form .= '<h2>Insert One Record</h2>';
        $record = new todo();
        $record->owneremail="bhumi@njit.edu";
        $record->ownerid=12;
        $record->createddate="00-00-0000";
        $record->duedate="11-11-1111";
        $record->message="testmessagebhumi";
        $record->isdone=1;
        $lastInsertedId=$record->save();
        $records = todos::findAll();
        $tableGen = htmlTable::genarateTableFromMultiArray($records);
        $form .= '<h3>After Inserting</h3>';
        $form .= $tableGen;

        //update one record
        $form .= '<h2>Update One Record</h2>';
        $records = todos::findOne($lastInsertedId);
        $record = new todo();
        $record->id=$records->id;
        $record->owneremail="bhumi11@njit.edu";
        $record->message="female";
        $record->save();
        $form .= '<h3>Record update with id: '.$records->id.'</h3>';
        $records = todos::findAll();
        $tableGen = htmlTable::genarateTableFromMultiArray($records);
        $form .= $tableGen;

        //delete one record
        $form .= '<h2>Delete One Record</h2>';
        $records = todos::findOne($lastInsertedId);
        $record= new todo();
        $record->id=$records->id;
        $record->delete();
        $form .= '<h3>Record with id: '.$records->id.' is deleted</h3>';
        $form .= '<h3>After Delete</h3>';
        $records = todos::findAll();
        $tableGen = htmlTable::genarateTableFromMultiArray($records);
        $form .= $tableGen;

        $form .= '</form> ';
        print($form);
    }
}
?>
