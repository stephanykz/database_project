<?php
   define('DB_DATABASE', 'omts_db');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_SERVER', 'localhost');

   function rootConnection(){
   		try{
   			$connection = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_DATABASE, DB_USERNAME, DB_PASSWORD);
   			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   			//echo "successfully made root account";
   			return $connection;
   		}
   		catch(PDOException $e) {
         	echo "Failed to create root connection in CONFIG" . $e->getMessage();
        }
   }

   function userConnection(){
   		$accountNum = $_SESSION["accountNum"];
   		$password = $_SESSION["password"];
   		// echo $password;
   		// echo $accountNum;

   		try{
   			$connection = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_DATABASE, $accountNum, $password);
   			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   			// echo "successfully made user account";
   			return $connection;
   		}
   		catch(PDOException $e) {
          	echo "Failed to create user connection in CONFIG" . $e->getMessage();
        }
   }
?>