<?php
if(!isset($_cookie["n_accessi"]))
{
    $valore=1;
    setcookie('n_accessi','$valore','time()+60*60*24*7');
}
else
{ 
  $valore=$_cookie["n_accessi"];
  setcookie("n_accessi","$valore");
}
echo "numero accessi :".$valore;
?>
