<!DOCTYPE html>
<html>
<head>
	<title>Ajutor Pet4Web</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style type="text/css">
	*{
		box-sizing:border-box;
	}
	.content{
		margin: 0 10px 0 10px;
		padding: 40px;
	}
	h1{
		text-align: center;
	}
	a {
		text-decoration: none;
	}
	a:hover{
		text-decoration: underline;
	}
	a:visited{
		color: #520052;
	}
	p{
		width: 0 auto;
	}
	#sterge{
		text-indent: 15px;
	}
	#editeaza{
		text-indent: 15px;
	}
	nav{
		padding: 20px;
	}
	li {
		list-style-type: square;
		font-size: 20px;
		display: inline;
		margin: 10px;
	}
	img{
		width: 0 auto;
		border:solid;
	}
	body{
		margin: 0 20px 0 20px;
		width: 0 auto;
		position: center;
		padding: 10px;
		background-color: #F5F0FF;
	}
	</style>
</head>
<body>
	<nav>
		<ul>
			<li><a href="#login" title="Login">Login</a></li>
			<li><a href="#logout" title="Logout">Logout</a></li>
			<li><a href="#register" title="Register">Register</a></li>
			<li><a href="#plantanoua" title="Planta noua">Planta noua</a></li>
			<li><a href="#rasfoieste" title="Rasfoieste">Rasfoieste</a></li>
			<li><a href="#search" title="Cauta">Cauta</a></li>
			<li><a href="#contact" title="Contact">Contact</a></li>
			<li><a href="#contulmeu" title="Contul meu">Contul meu</a></li>
			<li><a href="#editeaza" title="Editeaza cont">Editeaza cont</a></li>
			<li><a href="#admin" title="Admin">Admin</a></li>
		</ul>
	</nav>
	<div class="content">
	<h1>Manual de utilizare BoW</h1>
	<section id="login">
		<h2>Login.</h2>
		<p>Pentru a va loga pe site, apasati butonul <b>Login</b>. Introduceti numele de utilizator si parola pentru a continua, sau apasati butonul <b>Cont nou!</b> pentru a va crea un cont.</p>
		<img src="login1.png">
		<img src="login2.png">
	</section>
	<section id="logout">
		<h2>Logout.</h2>
		<p>Pentru a va deloga apasati butonul <b>Logout</b> din orice pagina a sitului.</p>
	</section>
	<section id="register">
		<h2>Register.</h2>
		<p>Aici va veti introduce datele cerute si apoi apasati butonul <b>Trimite</b> </p>
		<img src="register.png">
	</section>
	<section id="plantanoua">
		<h2>Adaugarea unei plante noi.</h2>
		<p>Puteti posta o planta noua dupa ce v-ati logat pe sit. Pentru a posta o planta, apasati pe butonul <b>Adaugareplanta noua</b> din bara de meniu. Aici veti completa campurile cu datele dorite si apoi apasati butonul <b>Posteaza</b>.</p>
		<img src="adauga2.png">
		<p>Acum planta adaugata de dumneavostra este listata. </p>
		<img src="adauga3.png">
	</section>
	<section id="rasfoieste">
		<h2>Vizualizarea tuturor plantelor</h2>
		<p>Pentru a vizualiza toate plantele de pe sit, apasati pe butonul <b>Rasfoieste plante</b> din bara de meniu. Vor fi afisate toate plantele postate.</p>
		<img src="rasfoieste.png">
	</section>
	<section id="search">
		<h2>Cautarea unei plante dupa nume</h2>
		<p>Pentru a cauta o anumita planta, introduceti numele in casuta de cautare din partea stanga si apasati tasta <b>Enter</b>.</p>
		<img src="cautare1.png">
		<h2>Cautarea multi-criteriala</h2>
		<p>Pentru a cauta o anumita planta, selectati criteriile dorite si apasati butonul <b>Trimite!</b>.</p>
		<img src="cautarem1.png">
		<img src="cautarem2.png">
	</section>
	<section id="contact">
		<h2>Contactarea adminilor</h2>
		<p>Pentru a putea adresa o intrebare adminilor sau pentru a lasa feedback, apasati butonul <b>Contact</b> din bara de meniu si apoi completati campurile din formular.</p>
		<img src="contact.png">
	</section>
	<section id="contulmeu">
		<h2>Accesarea contului de utilizator</h2>
		<p>Daca doriti sa modificati/stergeti o planta, sau sa modificati datele de utilizator, atunci trebuie sa apasati butonul <b>Contul meu</b> din bara de meniu. Apoi, veti fi redirectionat pe pagina contului dumneavoastra. Din aceasta pagina puteti sa va modificati datele contului si sa modificati/stergeti plantele postate.</p>
		<img src="contulmeu2.png">
		<section id="editeaza">
			<h3>Editeaza date utilizator</h3>
			<p>Pentru a edita datele dumneavoastra, apasati butonul <b>Editeaza date</b>. Veti fi redirectionat pe pagina de modificare a datelor. De aici puteti modifica numele, parola sau data nasterii. Numele de utilizator si adresa de email nu pot fi modificate. Apasati butonul <b>Trimite!</b> pentru a actualiza datele. </p>
			<img src="editcont.png">
		</section>
	</section>
	<section id="admin">
		<h2>Zona admin</h2>
		<p>Pentru a putea accesa zona de admin trebuie doar sa introduceti din pagina de login numele de utilizator si parola de administrator. Un cont de administrator nu poate fi creat decat de administratorul bazei de date. Daca numele de utilizator si parola corespund cu cele ale unui admin, atunci veti fi redirectionat in zona de admin. Aici puteti exporta date in formatele <em>CSV si XML</em>.</p>
		<img src="admin2.png">
		<p>De asemenea, puteti sterge mesaje sau utilizatori.</p>
		<img src="admin1.png">
	</section>
</div>


</body>
</html>