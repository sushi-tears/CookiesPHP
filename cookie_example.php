<?php   
    // Jake Levy - 6 Nov 2021
    $cookie_info = "No cookie info to display...press a button";

    if (isset($_POST['test'])){
        //Create a test cookie with a 60-second lifetime
        setcookie("test", "test", time() + 60, '/');

        //set text indicating success or failure of creating the cookie
        $cookie_info = (count($_COOKIE) > 0)
            ? "Cookies are enabled" : "Cookies are disabled";
    }

    else{
        $cookie_name = "clicks";

        if (isset($_POST['click_count'])){
            //Get the clicks cookie value, if set - otherwise 1
            $cookie_value = isset($_COOKIE[$cookie_name])
                ? $_COOKIE[$cookie_name] : 0;

            //Set display text to the cookie value
            $cookie_value++;
            $cookie_info = "Number of clicks: " . $cookie_value;

            //Create or update the cookie to the click value; 1 hour expiration
            setcookie($cookie_name, $cookie_value, time() + 3600, "/");
        }

        else if (isset($_POST['delete'])){
            //delete the cookie by setting expiration to one hour in the past
            setcookie($cookie_name, 0, time() - 3600, "/");
            $cookie_info = "Click cookie deleted";
        }

        else if (isset($_COOKIE[$cookie_name])){
            $cookie_value = $_COOKIE[$cookie_name];
            $cookie_info = "Number of clicks: " . $cookie_value;
        }
    }
?>

<html>
<body>
    <form method="POST">
        <p><?php echo $cookie_info; ?></p>
        <input type="submit" value="Test Cookies" name="test"/>
        <input type="submit" value="Count Clicks" name="click_count"/>
        <input type="submit" value="Delete Clicks" name="delete"/>
    </form>
</body>
</html>