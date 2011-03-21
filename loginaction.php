<?
    $latidude_code = $_POST['latidude_code'];
    setcookie("latidude_code", "$latidude_code", time()+(100*24*3600));
    header('location: simpleTest.php');
?>
