<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>
	</title>
	<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous">
  </script>
</head>
<body>

<form id="myForm">
<span>Показать товары, у которых </span>
<select id="input1">
          <option value="cost">Розничная цена</option>
          <option value="cost_opt">Оптовая цена</option>
        </select>
<span>от</span>
<input id="input2" type="text"  value="" placeholder= "от" >
<span>до</span>
<input id="input3" type="text"  value="" placeholder= "до" >
<span>рублей и на складе </span>
<select id="input4">
          <option value=">">Более</option>
          <option value="<">Менее</option>
        </select>
<span>штук.</span>
<input id="input5" type="text" value="" placeholder= "количество" >
</form>
<button type="button" id ="clickButton">ПОКАЗАТЬ ТОВАРЫ</button>	

<div id="table"	>
<?php
$mysqli = new mysqli("localhost", "root", "", "pricelist");
$query = "SELECT * FROM price2";
$query_res = mysqli_query($mysqli, $query);


//счетчик строк	
	$i=0;
//предупреждение 
	$note_text = "Осталось мало!! Срочно докупите!!!";

if($query_res) {
    echo ("<table  >
        <tr>          
            <th>Наименование товара</th>
            <th>Cтоимость, руб</th>
            <th>Cтоимость опт, руб</th>
            <th>Наличие на складе 1, шт</th>
            <th>Наличие на складе 2, шт</th>
            <th>Cтрана производства</th>
            <th>Примечание</th>
        </tr>");

        while($row = mysqli_fetch_assoc($query_res)){
        echo ("<tr>");
          echo ("<td>$row[name]</td>");
              
				echo("<td>$row[cost]</td>");
				echo("<td>$row[cost]</td>");
				echo("<td>$row[cost_opt]</td>");			
				echo("<td>$row[stock_availability1]</td>");
				echo("<td>$row[stock_availability2]</td>");
				echo ("<td>$row[country]</td>");
				
				//если товара на складе мало - вывести предупреждение
				if($row[stock_availability1]<= 20 || $row[stock_availability2]<= 20){
					$row[note] = $note_text;
					echo ("<td>$row[note]</td>");
					}
					else {
				echo ("<td>$row[note]</td>");
		}
		
		$sum1 += $row[stock_availability1];
		$sum2 += $row[stock_availability2];
		
		$cost_rozn += $row[cost];
		$cost_opt += $row[cost_opt];
		$i++;
        
		echo("</tr>");
		}
}

  echo ("</table>"); 
  
$mysqli->close();
?>

</div>
<script src="pricelist.js"></script>
</body>
</html>	