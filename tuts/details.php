<?php 
include('config/db_connect.php');

if(isset($_POST['delete'])){

    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

    $sql = "DELETE FROM classes WHERE id = $id_to_delete";

    if(mysqli_query($conn, $sql)){
        //success
        header('Location: index.php');
    } {
        //failure
        echo 'query error: ' . mysqli_error($conn);
    }
    
}


//check GET request id pcntl_alarm
if(isset($_GET['id'])){
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // make SQL query
    $sql = "SELECT * FROM classes WHERE id = $id";

    // get the query result
    $result = mysqli_query($conn, $sql);

    // fetch result in array format
    $class = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($conn);

    //print_r($class);
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include('Templates/header.php') ?> 

<div class="container center grey-text">
    <?php if($class): ?>

        <h4><?php echo htmlspecialchars($class['Name']);?></h4>
        <p>Created by: <?php echo htmlspecialchars($class['Email']); ?></p>
        <p><?php echo date($class['created_at']); ?></p>
        <h5>Class Abilities:</h5>
        <p><?php echo htmlspecialchars($class['Class_Abilities']); ?> </p>

        <!-- Delete Form -->
        <form action="details.php" method="POST">
            <input type="hidden" name="id_to_delete" value="<?php echo $class['id'] ?>">
            <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
        </form>


    <?php else: ?>
        <h5>Class not yet created!</h5>
    <?php endif; ?>
    
</div>



<?php include('Templates/footer.php') ?>


</html>