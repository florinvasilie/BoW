<aside>
	<form action="cautare.php" method="post">
		<label for="search" class="sr-only">Search</label>
		<input type="search" name="search" placeholder="Cautare" id="search" pattern="[A-Za-z]+" title="Doar litere!">
	
	</form>



	<form action="cautare_multi.php" method="post">	
		<h2>Categorie</h2>
			<div class="form-group">
				<label >Plante mediteraneene</label>
				<input name="mediteraneene" value="Mediteraneene" type="checkbox">

				<label>Plante asiatice</label>
				<input name="asiatice" value="Asiatice" type="checkbox">
		
				<label >Conifere</label>
				<input name="conifere" value="Conifere" type="checkbox" >
			
				<label >Foioase</label>
				<input  name="foioase" value="Foioase" type="checkbox">
			
				<label >Plante de stepa</label>
				<input name="stepa" value="Stepa" type="checkbox">
			</div>

		<h2>Beneficii</h2>
			<div class="form-group">
				<label >Estetica</label>
				<input name="estetica" value="Estetica" type="checkbox">

				<label>Parfum</label>
				<input name="parfum" value="Parfum" type="checkbox">
		
				<label >Uz medicinal</label>
				<input name="medicinal" value="Medicinal" type="checkbox" >
			
				<label >Plante fructifere</label>
				<input  name="fructifer" value="Fructifer" type="checkbox">
			
			</div>	
		<button class="btn-primary pull-right" name="buton" type="submit">
				Trimite!</button>
	</form>
	
</aside>