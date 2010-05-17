<?php
require_once('./PHPCaskSessionHandler.class.php');

$sh = new PHPCaskSessionHandler('phpcask@localhost', 'OSUCHJLZLTZQBVWFCRAA');

session_set_save_handler(  
    array($sh,"open"),  
    array($sh,"close"),  
    array($sh,"read"),  
    array($sh,"write"),  
    array($sh,"destroy"),  
    array($sh,"gc")
);

session_start();
?>
<?php
if (!isset($_SESSION['counter'])) {
  $_SESSION['counter'] = 1;
} else {
  $_SESSION['counter']++;
}
?>
Counter: <?php echo $_SESSION['counter']; ?><br />