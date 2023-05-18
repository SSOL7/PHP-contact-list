<!DOCTYPE html>    
<html>    
<head>    
<style>    
.error {color: #FF0001;}    
</style>    
</head>    
<body>
<?php    
// define variables to empty values    
$nameError = $emailError = $mobile_numberError = $genderError = $websiteError = $hobbyError = "";    
$name = $email = $mobile_number = $gender = $website = $hobby = "";    
//Input fields validation    
if ($_SERVER["REQUEST_METHOD"] == "POST") {    
    //String Validation    
    if (empty($_POST["name"])){            
        $nameError = "Name is required";        
    } else {            
        $name = input_data($_POST["name"]);    
        // check if name only contains letters and whitespace    
        if (!preg_match("/^[a-zA-Z ]*$/",$name)){ 
            $nameError = "Only alphabets and white space are allowed";            
        }
    }        
    //Email Validation         if (empty($_POST["email"])) {           $emailError = "Email is required";        } else {
       $email = input_data($_POST["email_address"]);    
              // check that the e-mail address is well-formed    
              if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
            $emailError = "Invalid email format";            }
    }    
    //Number Validation        
    if (empty($_POST["mobile_number"])) {
           $mobile_numberError = "Mobile no is required";        
       } else {
        $mobile_number = input_data($_POST["mobile_number"]);           
        // check if mobile no is well-formed            
        if (!preg_match ("/^[0-9]*$/", $mobile_number) ) { 
            $mobile_numberError = "Only numeric value is allowed.";            
        }
        //check mobile no length should not be less and greater than 10    
                 if (strlen ($mobile_number) != 10) {    
                     $mobile_numberError = "Mobile no must contain 10 digits.";    
              }
    }    
              
//URL Validation              
    if (empty($_POST["website"])){
         $website = "";    
    }else{    
        $website = input_data($_POST["website"]);
        // check if URL address syntax is valid    
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)){
             $websiteError = "Invalid URL";
        }
        }
    //Empty Field Validation    
    if (empty ($_POST["gender"])){
        $genderError = "Gender is required";    
    }else{
        $gender = input_data($_POST["gender"]);    
    }
    //Checkbox Validation    
    if (!isset($_POST['hobbies'])){    
        $hobbyError = "You must select hobby.";    
    }else{
        $hobby = input_data($_POST["hobbies"]);
    }    
function input_data($data){
    $data = trim($data);    
    $data = stripslashes($data);    
    $data = htmlspecialchars($data);    
    return $data;
}    
?>    
<h2>Registration Form</h2>    
<span class = "error">* required field </span>    
<br><br>    
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >         
    Name:    
    <input type="text" name="name">    
    <span class="error">* <?php echo $nameError; ?> </span>
    <br><br>    
    E-mail:
    <input type="text" name="email_address">    
    <span class="error">* <?php echo $emailError; ?> </span>
    <br><br>    
    Mobile No:    
    <input type="text" name="mobile_number">    
    <span class="error">* <?php echo $mobile_numberError; ?> </span>
    <br><br>    
    Website:    
    <input type="text" name="website">    
    <span class="error"><?php echo $websiteError; ?> </span>    
    <br><br>    
    Gender:
    <input type="radio" name="gender" value="male"> Male    
    <input type="radio" name="gender" value="female"> Female    
    <input type="radio" name="gender" value="other"> Other    
    <span class="error">* <?php echo $genderError; ?> </span>
    <br><br>    
    Hobbies:
    <input type="checkbox" name="hobbies" value="Reading"> Reading
    <input type="checkbox" name="hobbies" value="Writing"> Writing
    <input type="checkbox" name="hobbies" value="Playing"> Playing
    <span class="error">* <?php echo $hobbyError; ?> </span>
    <br><br>
    <input type="submit" name="submit" value="Submit">
    <br><br>                                                                      
</form>    
<?php    
    if(isset($_POST['submit']))    {
        if($nameError == "" && $emailError == "" && $mobile_numberError == "" && $genderError == "" && $websiteError == "" && $hobbyError == ""){
            echo "<h3 color = #FF0001> <b>You have sucessfully submitted the form.</b> </h3>";    
            echo "<h2>Your Input Fields are as below:</h2>";    
            echo "Name: " .$name;    
            echo "<br>";    
            echo "Email: " .$email;    
            echo "<br>";    
            echo "Mobile No: " .$mobile_number;    
            echo "<br>";    
            echo "Website: " .$website;    
            echo "<br>";    
            echo "Gender: " .$gender;    
            echo "<br>";
            echo "Hobby: " .$hobby;
        } else {    
            echo "<h3> <b>Carefully check the form fields before submitting it.</b> </h3>";    
        }
    }    
?>    
</body>    
</html>