<?php 

    include('config/db_connect.php');

    //write query for all classes
    $sql = 'SELECT Name, Class_Abilities, id FROM classes ORDER BY created_at';

    // make query & get result
    $result = mysqli_query($conn, $sql);

    // fetch resulting rows as an array
    $classes = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // free result from memory
    mysqli_free_result($result);

    // close connection
    mysqli_close($conn);
    
    //print_r($classes);

    //seperating values in Class_abilities col.
    //explode(',', $classes[0]['Class_Abilities']);


?>

<!DOCTYPE html>
<html lang="en">

    <?php include('Templates/header.php') ?>
    <h4 class="center grey-test"></h4>

    <div class="container">
        <div class="row">

        <?php foreach($classes as $class): ?>

            <div class="col s6 md3">
                <div class="card z-depth-0"> 
                    <img src="img/image.png" class="class">
                    <div class="card-content center">
                        <h6><?php echo htmlspecialchars($class['Name']) ?></h6>
                        <ul>
                            <?php foreach(explode(', ', $class['Class_Abilities']) as $ability): ?>
                                <li><?php echo htmlspecialchars($ability) ?></li>
                           <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="card-action right-align"></div>
                    <a href="details.php?id=<?php echo $class['id']?>" class="brand-text">more info</a>
                </div>
            </div>

       <?php endforeach; ?>

        </div>

    </div>


    <?php include('Templates/footer.php') ?>

</body>
</html>