<?php //estoy entrando en 'php' similar como funcionaba oracle y plsql
// todas las variables se externizan fuera del html se "escriben" usando variables.
// puede esto ayudar a formar "modulos" que hacen el codigo repetible?
$hola = 'brum brum';
$var_html = '<h1> HTML o PHP?</h1> <p> estoy dentro del servidor y visualizo</p>';
/* function d($data){
    echo '<pre>';
    var_data($data);
    echo'</pre>';
} */
$balance = 100;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body><!--  -->
<?php echo $hola ." / ". $var_html;?>
<!-- <?php d($balance);?> -->
</body>
</html>