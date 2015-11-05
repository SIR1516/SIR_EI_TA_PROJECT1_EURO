<?php
class Chave {
	public $numeros = array();
	public $estrelas = array();
};


class Gerador {
	public $chave;
	
	public function __construct() {
		$this->chave = new Chave();
		
		$todosnumeros = array();
		for($i=0; $i < 50; $i++ ) {
			$todosnumeros[] = $i+1;
		}
		
		for($i=0; $i<5; $i++) {
			$rindex = rand(0, count($todosnumeros)-1);
			$n = array_splice($todosnumeros,$rindex,1);
			$this->chave->numeros[] = $n[0];
		}
		
		sort($this->chave->numeros,SORT_NUMERIC);
		
		$todosestrelas = array();
		for($i=0; $i < 11; $i++ ) {
			$todosestrelas[] = $i+1;
		}
		
		for($i=0; $i<3; $i++) {
			$rindex = rand(0, count($todosestrelas)-1);
			$e = array_splice($todosestrelas,$rindex,1);
			$this->chave->estrelas[] = $e[0];
		}
		sort($this->chave->estrelas,SORT_NUMERIC);
	}
	
	
	public function toJSON() {
		return json_encode($this->chave);
	}
	
	// return a XML document (string)
	public function toXML() {
		$xmldoc = new SimpleXMLElement("<chave></chave>");
			$xn = $xmldoc->addChild("numeros");
			foreach ($this->chave->numeros as $numero) {
				$xn->addChild("num",$numero);
			}
			
			$xe = $xmldoc->addChild("estrelas");
			foreach ($this->chave->estrelas as $estrela) {
				$xe->addChild("num",$estrela);
			}
			
		return $xmldoc->asXML();
	}
	
}

$gera = new Gerador();
header("Content-type: text/xml");
echo ($gera->toXML());

//echo '{"numeros":[1,2,3,4,5],"estrelas":[1,2]}';



?>