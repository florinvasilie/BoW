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
include('C:\xampp\php\PEAR\fpdf\fpdf.php');
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',16);
require_once('apps/database.php');
try{
		$db= new Database();
	}catch(Exception $e){
		die("Eroare server: ".$e->getMessage());
	}
	try{
		$rez=$db->execFetchAll("select titlu,vizualizari as maxim from petitii where vizualizari=(select max(vizualizari) from petitii)");
	}catch(Exception $e){
		die("Eroare server: ".$e->getMessage());
	}
	$pdf->Text(20,40,"Cea mai vizualizata petitie: ");
	$i=40;
		foreach($rez as $r){
					$i+=5;
					$pdf->Text(20,$i,$r['TITLU'].": " . $r['MAXIM']. " vizualizari");
		}

	try{
		$rez=$db->execFetchAll("SELECT * FROM (SELECT titlu,data_postarii FROM petitii ORDER BY data_postarii DESC) WHERE ROWNUM<=1");
	}catch(Exception $e){
		die("Eroare server: ".$e->getMessage());
	}
	$i+=10;
	$pdf->Text(20,$i,"Cea mai recenta petitie: ");
	
	foreach($rez as $r){
				$i+=5;
				$pdf->Text(20,$i,$r['TITLU'].": " ." din data: ".$r['DATA_POSTARII']);
	}
	try{
		$rez=$db->execFetchAll("SELECT P.TITLU,P.USERNAME,COUNT(S.ID_PETITIE),S.ID_PETITIE FROM SEMNATURI S JOIN PETITII P ON
								s.id_petitie=p.id_petitie group by p.username,p.titlu,s.id_petitie 
								having count(s.id_petitie)=(select max(count(id_petitie)) from semnaturi group by id_petitie)");
	}catch(Exception $e){
		die("Eroare server: ".$e->getMessage());
	}
	$i+=10;
	$pdf->Text(20,$i,"Cea/cele mai votata/e petitie este:");
	foreach($rez as $r){
				$i+=5;
				$pdf->Text(20,$i+5,$r['TITLU'].": " ." si a fost propusa de : ".$r['USERNAME']);
	}
	
	$pdf->Text(20,$i+15,"Utilizatorul/utilizatorii cu cele mai multe petitii propuse este/sunt:");
	try{
		$rez=$db->execFetchAll("SELECT USERNAME,COUNT(username) FROM PETITII GROUP BY USERNAME
							HAVING COUNT(username)=(SELECT MAX(COUNT(username)) FROM petitii GROUP BY USERNAME)");
	}catch(Exception $e){
		die("Eroare server: ".$e->getMessage());
	}
	foreach($rez as $r){
				$pdf->Text(20,$i+20,$r['USERNAME']);
	}
	$i+=30;
	$pdf->Text(20,$i,"Utilizatorul care a votat cele mai multe petitii este: ");
	try{
		$rez=$db->execFetchAll("SELECT USERNAME,COUNT(USERNAME) FROM SEMNATURI GROUP BY USERNAME HAVING
					COUNT(USERNAME)=(SELECT MAX(COUNT(USERNAME)) FROM SEMNATURI GROUP BY USERNAME)");
	}catch(Exception $e){
		die("Eroare server: ".$e->getMessage());
	}
	foreach($rez as $r){
				$i+=5;
				$pdf->Text(20,$i,$r['USERNAME']);
	}


$pdf->Output();
?>