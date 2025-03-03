<?php

include_once 'user.php';

class Validator{
    private $conn;
    private $errors = [];


    // Check empty fields
    public function isNotEmpty($field, $label){
        if (empty($field)){
            $this->errors[] = "{$label} cannot be empty.";
        }
    }

    //Validate Email
    public function isValidName($name){
        if (strlen($name) < 4){
            $this->errors[] = "{$name} Your name should be More than 4 Characters.";
        }
        if (!ctype_alnum($name)){
            $this->errors[] = "Username should contain alphanumeric characters only.";
        }
    }


    //Email
    public function emailValid($email, $conn){
        if(strlen($email) < 1){
            $this->errors[] = "Please Enter an email address.";
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $this->errors[] = "Please Enter a valid email address.";
        }

        //Check  if user is registered
        $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE email=?");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $stmt->bind_result($emailCount);
        $stmt->fetch();
        if ($emailCount > 0) {
            $this->errors[] = "An Account is already registered with the Email address. You can proceed to Login";
        }
    }
    
    //Phone number validation
    public function phoneValid($phone, $conn){
        if (strlen($phone) <= 11) {
            $this->errors[] = "Please enter a valid phone number with Country code";
        }

        //If Phone number is registered
        $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE phone = ?");
        $stmt->bind_param("s", $phone);
        $stmt->execute();
        $stmt->bind_result($phoneCount);
        $stmt->fetch(); 

        if ($phoneCount > 0) {
            $this->errors[] = "Phone number already exists.";
        }
    }

    //Password Validation
    public function PassValid(){
        if (strlen($password) < 8) {
            $this->errors[] = "Password must be more than 8 characters.";
        }
    }


    //Image Validation
    public function ImageValidate($image){
        $allowed = ['jpg', 'png', 'gif', 'jpeg'];
        $imageFileType = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        if (!in_array($imageFileType, $allowed)){
            $this->errors[] = "Unsupported Image File Type. Only jpg, gif, jpeg and png are allowed";
        }
    }

    //get error messages
    public function getErrors(){
        return $this->errors;
    }

    //Check if values have passed validation
    public function hasErrors(){
        return !empty($this->errors);
    }





}






?>