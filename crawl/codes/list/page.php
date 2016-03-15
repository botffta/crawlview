<?php 

class Page
{
	public $urlhead;	//the header of url
	public $tourl;	//the url to view
	private $next_url;	//the url of next page
	private $prev_url;	//the url of previous page
	private $dom;
	private $xpath;
	private $exps;

	/*from another object 
	this way can reduce the times of access the target*/
	function __construct($param)
	{
		$this->dom = $param->get_dom();
		$this->xpath = $param->get_xpath();
		$this->exps = $param->get_exps();
		$this->urlhead = $this->exps['page']['urlhead'];
		$this->tourl = $this->exps['page']['tourl'];
	}

	public function show_previous()
	{
		$this->acquire_prevurl();
		if($this->prev_url->length == 0)
			echo '<span class="pagebox">previous</span>';
		else
		{
			echo '<a class="pagebox" href="';
			echo $this->tourl.'?param='.$this->urlhead.$this->prev_url->item(0)->nodeValue;
			echo '">previous</a>';
		}
	}

	public function show_next()
	{
		$this->acquire_nexturl();
		if($this->next_url->length == 0)
			echo '<span class="pagebox">next</span>';
		else
		{
			echo '<a class="pagebox" href="';
			echo $this->tourl.'?param='.$this->urlhead.$this->next_url->item(0)->nodeValue;
			echo '">next</a>';
		}
	}

	//get the next url
	private function acquire_nexturl()
	{
		$nexturl_exp = $this->exps['page']['next_exp'];
		$this->next_url = $this->xpath->query($nexturl_exp);	//parse
		return $this->next_url;
	}

	//get the previous url
	private function acquire_prevurl()
	{
		$prevurl_exp = $this->exps['page']['prev_exp'];
		$this->prev_url = $this->xpath->query($prevurl_exp);	//parse
		return $this->prev_url;
	}

	//show
	public function listall()
	{
		$this->show_previous();
		for($num=0; $num<14; $num++)
			echo "&emsp;";
		$this->show_next();
	}
}
