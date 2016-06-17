<?php 
	class paginare	{
		
		function __construct()
		{
			require_once("database.php");
		}

		public function rasfoieste($Page,$Per_page,$Nr_linii,$sql,&$Num_Pages){
			$Prev_Page = $Page-1;
			$Next_Page = $Page+1;
			$ok=$Num_Pages;
			if($Nr_linii<=$Per_page)
			{
				$Num_Pages =1;
			}
			else if(($Nr_linii % $Per_page)==0)
			{
				$Num_Pages =($Nr_linii/$Per_page) ;
			}
			else
			{
				$Num_Pages =($Nr_linii/$Per_page)+1;
				$Num_Pages = (int)$Num_Pages;
			}
			if($Page>$Num_Pages){
				$Page=$Num_Pages;
			}
			if($Page<1){
				$Page=1;
			}
			$offset=30*($Page-1)+1;
			$nrez=30+($Page-1)*30;

			try{
				$db = new Database();
			}catch(Exception $e){
				die("<p> Serverul a intampinat o eroare: ".$e->getMessage()."</p>");
			}
			try{
				$rez=$db->execFetchAll($sql,array(array(":offs",$offset,-1),array(":rezt",$nrez,-1)));
			}catch(Exception $e){
				die("<p>Serverul a intampinat o eroare: ".$e->getMessage()."</p>");
			}
			if ($Page==$Num_Pages){
				if ($Num_Pages % $Per_page!=0){
					$limit=$Nr_linii-($Num_Pages-1)*$Per_page;
				}
			}
			else $limit=30;

			if($Prev_Page && $ok!="OK")
			{
				echo " <a class=\"btn-primary\" href='$_SERVER[SCRIPT_NAME]?Page=1'><< First</a> ";
				echo " <a class=\"btn-primary\" href='$_SERVER[SCRIPT_NAME]?Page=$Prev_Page'><< Back</a> ";
			}
			if($Page!=$Num_Pages)
			{
				echo " <a class=\"btn-primary\" href ='$_SERVER[SCRIPT_NAME]?Page=$Next_Page'>Next>></a> ";
				echo " <a class=\"btn-primary\" href ='$_SERVER[SCRIPT_NAME]?Page=$Num_Pages'>Last>></a> ";
			}	

			return $rez;
		}
	}

?>