<?php

declare(strict_types=1);

//we are going to use session variables so we need to enable sessions
SESSION_START();
//Variables
$addressStreet=(!empty($_SESSION["s_addressStreet"])) ? $_SESSION["s_addressStreet"] : "";
$streetNumber=(!empty($_SESSION["s_streetNumber"])) ? $_SESSION["s_streetNumber"] : "";
$city=(!empty($_SESSION["s_city"])) ? $_SESSION["s_city"]:"";
$zipCode=(!empty($_SESSION["s_zipCode"])) ? $_SESSION["s_zipCode"] : "";


$email= "";
$selectedProducts=[];
$errMessage="";
$totalValue = 0;

 
//gettin the options to order food=1 : order food,  food=0: order drinks
$food=(isset($_GET["food"])) ? $_GET["food"] : "1";

//your products with their price.
if ($food == '1'){
$products = [
  ['name' => 'Club Ham', 'price' => 3.20],
  ['name' => 'Club Cheese', 'price' => 3],
  ['name' => 'Club Cheese & Ham', 'price' => 4],
  ['name' => 'Club Chicken', 'price' => 4],
  ['name' => 'Club Salmon', 'price' => 5] 
];
}else{  
  $products = [
    ['name' => 'Cola', 'price' => 2],
    ['name' => 'Fanta', 'price' => 2],
    ['name' => 'Sprite', 'price' => 2],
    ['name' => 'Ice-tea', 'price' => 3],
];

}

function cleanInput($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
};

function validateData():bool{
    
    global $errMessage,$email,$addressStreet,$streetNumber,$city,$zipCode,$selectedProducts,$products; // TODO: fix dirty code    

    //Validate e-mail 
    if (empty($_POST["email"])){
        $errMessage=$errMessage."e-mail is empty !";
    }else{
     $email=cleanInput($_POST["email"]);
     if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errMessage=$errMessage."Invalidate email !";
     } 
    }
 
    //validate address-street
    if (empty($_POST["street"])){
         $errMessage=$errMessage.", Street name is empty !";
    }else{
     $addressStreet=cleanInput($_POST["street"]); 
     if (!preg_match("/^[a-zA-Z-' ]*$/",$addressStreet)) {
        $errMessage=$errMessage.", Street name Only letters and white space allowed !";        
      }
    }
 
    //validate address-street-number
    if (empty($_POST["streetnumber"])){
         $errMessage=$errMessage.", Street Number is empty !";
    }else{
     $streetNumber=cleanInput($_POST["streetnumber"]); 
     if (!filter_var($streetNumber,FILTER_VALIDATE_INT) ){
         $errMessage=$errMessage.", Street number Only number allowed !"; 
     }
    }
 
    //validate address-city
    if (empty($_POST["city"])){
         $errMessage=$errMessage.", City is empty";
    }else{
     $city=cleanInput($_POST["city"]); 
    }
 
    //validate address-Zip Code
    if (empty($_POST["zipcode"])){
         $errMessage=$errMessage.", ZipCode is empty !";
    }else{
     $zipCode=cleanInput($_POST["zipcode"]); 
     if(!filter_var($zipCode,FILTER_VALIDATE_INT)){
      $errMessage=$errMessage.", Zipcode Only number allowed !"; 
     }
    }    
    
   //Validate product Selection
   if (empty($_POST["products"])){
    $errMessage=$errMessage.", At least one product has to be selected (Order empty) :( !"; 
   }else{
     foreach ($_POST["products"] as $index => $productOrdered) {            
      $selectedProducts[$products[$index]['name']] =$productOrdered;   
     }
    
   }

   if (!empty($errMessage)){
     $errMessage="Please check and fix this issues :) : ".$errMessage;
     $errMessage= " <div class='alert alert-dismissible alert-warning'>
     <button type='button' class='close' data-dismiss='alert'>&times;</button> 
     <h4 class='alert-heading'>Warning!</h4> 
     <p class='mb-0'>$errMessage
     </p>
 </div>";
    return false; 
   } else{
     return true;
   }
 };
 

// function whatIsHappening() {
//     echo '<h2>$_GET</h2>';
//     var_dump($_GET);
//     echo '<h2>$_POST</h2>';
//     var_dump($_POST);
//     echo '<h2>$_COOKIE</h2>';
//     var_dump($_COOKIE);
//     echo '<h2>$_SESSION</h2>';
//     var_dump($_SESSION);
// }


// whatIsHappening(); 
if ($_SERVER["REQUEST_METHOD"]=="POST"){    
  // whatIsHappening(); 
  if(validateData()){    
      //Saving in session variables
      $_SESSION["s_addressStreet"]=$addressStreet;
      $_SESSION["s_streetNumber"]=$streetNumber;
      $_SESSION["s_city"]=$city;
      $_SESSION["s_zipCode"]=$zipCode;
      
    };
     var_dump($_POST);
};

// whatIsHappening();
require 'orderForm.php';