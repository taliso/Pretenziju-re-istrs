<?php            
//Logika, kas apstrada / izvada formas datus
if (isset($_POST['form-submit']))
{
  echo "Forma aizpildita!<br />";
  echo "Noraditais vards: {$_POST['fname']}<br />";
  echo "Noraditais uzvards: {$_POST['lname']}<br />";
  echo "<hr />";
  
  define("HOST", "127.0.0.1");
  define("USER", "root");
  define("DB", "phpshack");
  define("PASS", "");
  
  /* PIESLEG�ANAS BATUBAZEI */
  //Definetas konstantes tiek izmantotas
  $db = new PDO("mysql:host=".HOST.";dbname=".DB,USER,PASS,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
  //Parametrs, kas nosaka, ka kludas tiks izvaditas uz ekrana
  //Kamer izstrada programmu, ir loti noderigs
  $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
  
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  
  // �im piemeram tabulai data jaeksiste iek� "phpshack" datubazes
  // Tabulai jabut 2 obligatajiem (required) laukiem - fname un lname
  $sql = "INSERT INTO data SET fname=:fname, lname=:lname";
  $q = $db->prepare($sql);
  $q->execute(array(':fname'=>$fname,':lname'=>$lname));
    
}
else
{
    echo "Aizpildiet formu!";
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Formas</title>
    </head>
    <body>
        
        <h1>Forma</h1>
        <form action='index.php' method="post">
            <input type='text' name='fname' placeholder="Vards"><br /><br />
            <input type='text' name='lname' placeholder="Uzvards"><br /><br />
            <input type='submit' name='form-submit' value='OK'><br />
        <form>
        
    </body>
</html>