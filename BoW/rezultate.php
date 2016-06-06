<?php
 /* Copyright (C) <2015>  <Pohrib Petre Mihail & Vasilie Florin Paul>

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.*/
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Pet4Web</title>
	<script src="resources/js/afisarebutoane.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="resources/css/main.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body onload="showButton()">
<div class="container">
	<?php
		require_once("header.php");
		require_once("apps/database.php");
		try{
			$db= new Database();
		}catch(Exception $e){
			die("Serverul a intalnit o eroare: ".$e->getMessage());
		}
		try{
			$rez=$db->execFetchAll("select id_petitie,titlu,username,data_postarii from petitii where upper(titlu) LIKE upper('%".$_REQUEST['search']."%')");
		}catch(Exception $e){
			die("Serverul a intalnit o eroare: ".$e->getMessage());
		}
		echo "<div class=\"main-content\">";
		if ($rez!=null){

			echo "<table>
				<tr>
				<th>Titlu</th>
				<th>Utilizator</th>
				<th>Data postarii</th>
				</tr>";
			foreach ($rez as $r) {
				echo "<tr>";
				echo "<td><a href=\"details.php?id=".$r['ID_PETITIE']."\">" . $r['TITLU']."</a></td>";
			    echo "<td>" . $r['USERNAME'] . "</td>";
			    echo "<td>" . $r['DATA_POSTARII'] . "</td>";
			    echo "</tr>";
			}
			echo "</table>";
			echo "</div>";
			
		}
		else{
			echo "<p>Nu a fost gasit nici un rezultat</p>";
			echo "</div>";
			require_once("leftside.php");
			require_once("footer.php");
		}
		
		require_once("leftside.php");
		require_once("footer.php");
	?>
</div>
</body>
</html>