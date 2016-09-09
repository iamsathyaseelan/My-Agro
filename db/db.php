<?php
mysql_connect('localhost','root','');
if(mysql_select_db('myagro')){echo "";}
else echo 'failed ';
?>