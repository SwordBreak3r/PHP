<?php 

   // if(isset($_GET['submit'])){
   //     echo $_GET['email'] . '<br>';
   //     echo $_GET['name'] . '<br>';
   //     echo $_GET['abilities'] . '<br>';
   // }



   include('config/db_connect.php');

    $name = $email = $ability = '';
    $errors = array('email'=>'', 'name'=>'', 'abilities'=>'');

   if(isset($_POST['submit'])){
    echo htmlspecialchars($_POST['email']) . '<br />';
    echo htmlspecialchars($_POST['name']) . '<br />';
    echo htmlspecialchars($_POST['abilities']) . '<br />';
   }
    //check email
    if(empty($_POST['email'])){
        $errors['email'] = 'An email is required';
    } else {
        $email = $_POST['email'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
          $errors['email'] = 'Email must be a valid email address';
        }
    }
    
    //check class name
    if(empty($_POST['name'])){
        $errors['name'] = 'A class name is required';
    } else {
        $name = $_POST['name']; 
        if(!preg_match('/^[a-zA-Z\s]+$/', $name)){
            $errors['name'] = 'Class name must be letters and spaces only';
        }
    }
    
    //check class abilities
    if(empty($_POST['abilities'])){
        $errors['abilities'] = 'Class abilities are required';
    } else {
        $ability = $_POST['abilities'];
        if(!preg_match('/^[a-zA-Z\s]+(?:,\s*[a-zA-Z\s]*)*$/', $ability)){
            $errors['abilities'] = 'Must use letters and be seperated by commas';
        }
    }

    if(array_filter($errors)){
        //echo 'Errors in the form';

    } else {
        
        //add SQLi filter to inputs
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $ability = mysqli_real_escape_string($conn, $_POST['abilities']);

        //create new variable
        $sql = "INSERT INTO classes(name,email,Class_Abilities) VALUES('$name','$email','$ability')";

        //save to db and check
        if(mysqli_query($conn, $sql)){
            //success
            header('Location: index.php');
        } else {
            //error
            echo 'query error: ' . mysqli_error($conn);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

    <?php include('Templates/header.php') ?>
    
    <section class="container grey-text">
        <h4 class="center">Add a Class</h4>
        <form action="add.php" method="POST" class="white">
        <label>Your Email:</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
        <div class="red-text"><?php echo $errors['email']; ?></div>
        <label>Class Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($name) ?>">
        <div class="red-text"><?php echo $errors['name']; ?></div>
        <label>Class Abilities (comma seperated):</label>
        <input type="text" name="abilities" value="<?php echo htmlspecialchars($ability) ?>">
        <div class="red-text"><?php echo $errors['abilities']; ?></div>
        <dev class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </dev>
        </form>


    </section>




    <?php include('Templates/footer.php') ?>

</body>
</html>