<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title><?php echo $classificationName; ?> vehicles | PHP Motors, Inc.</title>
    <link rel="stylesheet" href="../css/styles.css" type="text/css" media="screen">
</head>

<body>
    <div id="wrapper">
        <header>
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

        </header>
        <nav>
            <?php echo $navList; ?>
        </nav>
        <h1><?php echo $classificationName; ?> vehicles</h1>
        <?php if (isset($message)) {
            echo $message;
        }
        ?>
        <?php if (isset($vehicleDisplay)) {
            echo $vehicleDisplay;
        } ?>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>

</body>

</html>