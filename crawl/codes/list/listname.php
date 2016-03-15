<?php

class Listname
{
	public $inipath;
	private $url_target;	//the url of target from GET param
	private $xpath_exps;	//exps of xpath
	private $dom;
	private $xpath;

	function __construct($param)
	{
		//get url_target from GET-param
		if( empty($_GET['param']) )
			$this->outgram('get url target failed!');
		else
			$this->url_target = urldecode($_GET['param']);
		//get xpath_exps
		$this->set_inipath($param);
	}

	//Error message display
	private function outgram($info)
	{
		$message = 'ERROR: '.$info;
		exit($message);
	}

	//get this dom
	public function get_dom()
	{
		return $this->dom;
	}

	//get this xpath
	public function get_xpath()
	{
		return $this->xpath;
	}

	//get  xpath expression
	public function get_exps()
	{
		return $this->xpath_exps;
	}

	//set the path of ini document
	public function set_inipath($param)
	{
		$this->inipath = $param;
		$this->acquire_exps($this->inipath);
	}

	//parse the configuration file
	private function acquire_exps($param)
	{
		//set parse_ini_file second param to true for return Multidimensional array
		if( ($exps=parse_ini_file($param, true)) == FALSE )
			$this->outgram('ini file open failed!');
		else
		{
			$this->xpath_exps = $exps;
			return $this->xpath_exps;
		}
	}

	//get file contents
	private function acquire_contents($param)
	{
		$param = urldecode($param);	//decode the url
		if( ($contents = file_get_contents($param)) == FALSE)
			$this->outgram('get target file contents failed!');
		$res = mb_convert_encoding($contents, 'HTML-ENTITIES', 'UTF-8');
		return $res;
		//return $contents;
	}

	//parse the target dom
	private function parse_dom()
	{
		$contents = $this->acquire_contents($this->url_target);	//get file contents
		$this->dom = new DOMDocument();
		@$this->dom->loadHTML($contents);	//nothing display
		return $this->dom;
	}

	//parse xpath
	private function parse_xpath()
	{
		$this->xpath = new DOMXPath($this->dom);
		return $this->xpath;
	}

	//get branch_names to array
	private function branch_name()
	{
		$namexp = $this->xpath_exps['list']['name_exp'];	//get name expression
		$names = $this->xpath->query($namexp);	//parse
		return $names;
	}

	//get branch_urls to array
	private function branch_url()
	{
		$urlexp = $this->xpath_exps['list']['url_exp'];	//get url expression
		$urls = $this->xpath->query($urlexp);	//parse
		return $urls;
	}

	//get branch_times to array()
	private function branch_time()
	{
		$timexp = $this->xpath_exps['list']['time_exp'];	//get time expression
		$times = $this->xpath->query($timexp);	//parse
		return $times;
	}

	//main to deal
	public function listall()
	{
		$this->parse_dom();
		$this->parse_xpath();
		$names = $this->branch_name();
		$urls = $this->branch_url();
		$times = $this->branch_time();
		//show the list
		$num = 0;
		$tourl = $this->xpath_exps['list']['tourl'];
		$urlhead = $this->xpath_exps['list']['urlhead'];
		foreach($urls as $url)
		{
			echo '<ul><li><a target=_blank; href="';
			echo $tourl . $urlhead . $url->nodeValue . '">';
			echo $names->item($num)->nodeValue . '</a>  ';
			echo $times->item($num)->nodeValue;
			echo '</li></ul>';
			$num++;
		}
	}

}


?>
