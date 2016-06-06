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
	define('USERNAME','c##florin');
	define('PASSWORD','1234');
	define('DATABASE','localhost/orcl');

	class Database{
		protected $conn = null;
		protected $stid = null;
		protected $prefetch=100;

		function __construct(){
			$this->conn=oci_pconnect(USERNAME, PASSWORD, DATABASE);
			if (!$this->conn){
				$m=oci_error();
				throw new Exception('Nu s-a putut conecta la baza de date: '.$m["message"]);	
			}
		}
		function __destruct() {
	        if ($this->stid)
	            oci_free_statement($this->stid);
	        if ($this->conn)
	            oci_close($this->conn);
	    }
	    public function execute($sql,$bindvars=array()){
	    	$this->stid = oci_parse($this->conn, $sql);
	    	if (!$this->stid){
	    		$m=oci_error($this->conn);
	    		throw new Exception('Nu s-a putut parsa interogarea: '.$m["message"]);
	    	}
	        if ($this->prefetch >= 0) {
	            oci_set_prefetch($this->stid, $this->prefetch);
	        }
	        foreach ($bindvars as $bv) {
	            // oci_bind_by_name(resource, bv_name, php_variable, length)
	            oci_bind_by_name($this->stid, $bv[0], $bv[1], $bv[2]);
	        }
	        $r=oci_execute($this->stid, OCI_NO_AUTO_COMMIT);
	        if(!$r){
	        	 $m = oci_error($this->stid);
	        	 throw new Exception('Nu s-a putut executa interogarea: '.$m["message"]);
	        }
	        $r = oci_commit($this->conn);
	        if (!$r){
	        	$m=oci_error($this->conn);
	        	throw new Exception('Eroare la commit: '.$m["message"]);
	        }
	    }
	    public function execFetchAll($sql,$bindvars=array()){
	    	try{
	    	$this->execute($sql,$bindvars);
	    	oci_fetch_all($this->stid, $res, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);
	    	
	    	}catch(Exception $e){
	    		throw $e;
	    	}finally{
	    		$this->stid = null;
	    	}
	    	return($res);
	    }
	}
?>