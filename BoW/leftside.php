<aside>
	<form action="cautare.php" method="post">
		<label for="search" class="sr-only">Search</label>
		<input type="search" name="search" placeholder="Cautare" id="search" pattern="[A-Za-z]+" title="Doar litere!">
	
	</form>

	<?php
		require_once("header.php");
		require_once("apps/database.php");
		try{
			$db=new Database();
		}
		catch(Exception $e){
			die("Serverul a intalnit o eroare: ".$e->getMessage()); 
		}
		$sql="select UNIQUE CATEGORIE  from plante";
		$sql1="select UNIQUE BENEFICII  from plante";
		$sql2="select UNIQUE ORIGINE  from plante";
		$sql3="select UNIQUE REGIM_DEZV from plante";
		try{
			$rez=$db->execFetchAll($sql);
			$rez1=$db->execFetchAll($sql1);
			$rez2=$db->execFetchAll($sql2);
			$rez3=$db->execFetchAll($sql3);
		}
		catch(Exception $e){
			die("Serverul a intalnit o eroare: ".$e->getMessage());
		}  
		
	?>

	<form action="cautare_multi.php" method="post">	
		<h2>Categorie</h2>
		<?php
			foreach($rez as $r){
		?>
			<div class="form-group">
				<label ><?=$r['CATEGORIE']?></label>
				<input name="categorie[]" value="<?=$r['CATEGORIE'] ?>" type="checkbox">
			</div>
		<?php 
			} 
		?>
		<h2>Beneficii</h2>
		<?php
			foreach($rez1 as $r){
		?>
			<div class="form-group">
				<label ><?=$r['BENEFICII']?></label>
				<input name="beneficii[]" value="<?=$r['BENEFICII'] ?>" type="checkbox">
			</div>
		<?php 
			} 
		?>
		<h2>Origine</h2>
		<?php
			foreach($rez2 as $r){
		?>
			<div class="form-group">
				<label ><?=$r['ORIGINE']?></label>
				<input name="origine[]" value="<?=$r['ORIGINE'] ?>" type="checkbox">
			</div>
		<?php 
			} 
		?>
		<h2>Regim dezvoltare</h2>
		<?php
			foreach($rez3 as $r){
		?>
			<div class="form-group">
				<label ><?=$r['REGIM_DEZV']?></label>
				<input name="regim[]" value="<?=$r['REGIM_DEZV'] ?>" type="checkbox">
			</div>
		<?php 
			} 
		?>
		<button class="btn-primary pull-right" name="buton" type="submit">
				Trimite!</button>
	</form>
	
</aside>