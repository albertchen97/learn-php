<!DOCTYPE html>
<html>
    <head>
        <title>PHP Form Practice</title>
        <style type="text/css">
            .error{  /* Make error messages in red color. */
                color: red;
            }
        </style>
    </head>
    <body>
        <!-- Use PHP to handle data. -->
        <?php
            // Variables to store user input.
            $name=$email=$website=$comment=$gender="";
            // Variables to hold error messages.
            $nameErr=$emailErr=$websiteErr=$commentErr=$genderErr="";
            // Validate user's input.
            function validate_input($input){
                $input = trim($input);
                $input = stripslashes($input);
                $input = htmlspecialchars($input);
                return $input;
            }
            if($_SERVER["REQUEST_METHOD"] == "POST"){

                if (empty($_POST["name"])){
                    $nameErr = "Name is required!";
                } else {
                    $name = validate_input($_POST["name"]);
                    // Match regular expression pattern: only contains letters, dashes(-), apostrophes('), or whitespaces( ).                    
                    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {    
                        $nameErr = "Must only contains letters, dashes(-), apostrophes('), or whitespaces( ).!";
                    }
                }

                if (empty($_POST["email"])) {
                   $emailErr = "Email is required!"; 
                } else {
                    $email = validate_input($_POST["email"]);
                    // Validate email using PHP's filter_var() function.
                    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $emailErr = " Invalid email format!";
                    }
                }

                if (empty($_POST["gender"])) {
                   $genderErr = "Gender is required!";
                } else {
                    $gender = validate_input($_POST["gender"]);
                }

                if(!empty($_POST["website"])){
                    $website = validate_input($_POST["website"]);
                    // Validate URL using regular expressions.
                    if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9#%&?@\/=+_.~|!:,;]*[-a-z0-9#%&\/=+~_|]/i", $website)){
                        $websiteErr = " Invalid URL!";
                    }
                }

                if(!empty($_POST["comment"])){
                    $comment = validate_input($_POST["comment"]);
                }
            }
        ?>
        <h2>PHP Form Validation Example</h2>
        <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
	        Name: <input type="text" name="name" value="<?php echo $name ?>"><span class="error">*<?php echo $nameErr; ?></span>
            <br><br>
	        Email: <input type="text" name="email" value="<?php echo $email ?>"><span class="error">*<?php echo $emailErr; ?></span>
            <br><br>
	        Website: <input type="text" name="website" value="<?php echo $website ?>"><span class = "error"><?php echo $websiteErr; ?></span>
            <br><br>
	        Comment: <textarea name="comment"><?php echo "$comment"; ?></textarea>
            <br><br>
	        Gender: <input type="radio" name="gender" value="male" <?php if (isset($gender) && $gender=="male") echo "checked"; ?>>Male
		        <input type="radio" name="gender" value="female" <?php if (isset($gender) && $gender=="female") echo "checked"; ?>>Female
		        <input type="radio" name="gender" value="other" <?php if (isset($gender) && $gender=="other") echo "checked"; ?>>Other
                <span class="error">*<?php echo $genderErr; ?></span>
	       		<br><br>
        	<input type="submit" name="submit">
        </form >

		<!-- Display user's input. -->
		<h2>Your Input:</h2>
		<?php 
            echo "Name: " . $name . "<br>"; 
            echo "Email: " . $email . "<br>"; 
            echo "Website: " . $website . "<br>"; 
            echo "Comment: " . $comment . "<br>"; 
            echo "Gender: " . $gender . "<br>"; 
        ?>

    </body>
</html>