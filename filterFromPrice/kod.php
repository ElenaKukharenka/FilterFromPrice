<?php

$user = "root";
$pass = "root";
$host = "localhost";
$dbname = "pricelist";
try {
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
}
catch(PDOException $e){
echo $e->getMessage();
}

$t1 = $_POST['input1'];
$t2 = $_POST['input2'];
$t3 = $_POST['input3'];
$t4 = $_POST['input4'];
$t5 = $_POST['input5'];

if(isset($_POST['input2'])){
if(!preg_match("|^[\d]*$|", $_POST['input2'])){
echo "Введите целое число в поле 'от'!";
}
}

if(isset($_POST['input3'])){
if(!preg_match("|^[\d]*$|", $_POST['input3'])){
echo "Введите целое число в поле 'до'!";
}
}

if(isset($_POST['input5'])){
if(!preg_match("|^[\d]*$|", $_POST['input5'])){
echo "Введите целое число в поле 'количество'!";
}
}

$query2 = "SELECT * FROM price2 WHERE $t1 BETWEEN $t2 AND $t3 AND (stock_availability1 $t4 $t5 OR stock_availability2 $t4 $t5)";
$res = $pdo->prepare($query2);
$res->execute();

$data = $res->fetchAll();

echo ("<table  >
        <tr>          
            <th>Наименование товара</th>
            <th>Стоимость, руб</th>
            <th>Стоимость опт, руб</th>
            <th>Наличие на складе 1, шт</th>
            <th>Наличие на складе 2, шт</th>
            <th>Страна производства</th>
            <th>Примечание</th>
        </tr>"
		);
		
    foreach ($data as $key=>$row){
	echo ("<tr>");
	echo ("<td>$row[name]</td>");
	echo("<td>$row[cost]</td>");
	echo("<td>$row[cost_opt]</td>");				
			echo("<td>$row[stock_availability1]</td>");
				echo("<td>$row[stock_availability2]</td>");
				echo ("<td>$row[country]</td>");
				echo ("<td>$row[note]</td>");
      }
		echo("</tr>");

  echo ("</table>"); 
  
$pdo = null;
?>