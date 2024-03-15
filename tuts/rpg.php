
<?php
$arrays = [
    ['name' => 'Devon', 'class' => 'Warrior', 'spec' => 'Arms'],
    ['name' => 'Gandalf', 'class' => 'Wizard', 'spec' => 'Arcane'],
    ['name' => 'Marcus', 'class' => 'Druid', 'spec' => 'Shapeshifter']
    ]
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php foreach($arrays as $array){ ?>}

    <h3><?php echo $array['name']; ?></h3>
    <p><?php echo $array['class']; ?><p>

    <?php } ?>
</body>
</html>