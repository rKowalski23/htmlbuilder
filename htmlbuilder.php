<?php

abstract class AbstractHtmlBuilder
{
	abstract function getPage();
}

abstract class AbstractHtmlDirector
{
	abstract function __construct(AbstractHtmlBuilder $builder_in);
	abstract function buildHtml();
	abstract function getPage();
}

class HtmlPage
{
	private $page = NULL;
	private $page_title = NULL;
	private $page_header = NULL;
	private $page_body = NULL;
	
	function __construct()
	{

	}
	function showPage()
	{
		return $this->page;
	}
	function makeTitle($title)
	{
		$this->page_title = $title
	}
	function makeHeader($header);
	{
		$this->page_header = $header;
	}
	function makeText($text)
	{
		$this->page_text .= $text;
	}
	function formatPage()
	{
		$this->page = '<html>';
		$this->page .= '<head><title>'.$this->page_title.'</title></head>';
        $this->page .= '<body>';
        $this->page .= '<h1>'.$this->page_heading.'</h1>';
        $this->page .= $this->page_text;
        $this->page .= '</body>';
        $this->page .= '</html>';
	}
}

class HtmlBuilder extends AbstractHtmlBuilder
{
	private $page = NULL;
    function __construct() 
    {
      $this->page = new HTMLPage();
    }
    function makeTitle($title) 
    {
      $this->page->setTitle($title);
    }
    function makeHeading($heading) 
    {
      $this->page->setHeader($header);
    }
    function makeText($text_in) 
    {
      $this->page->setText($text);
    }
    function formatPage() 
    {
      $this->page->formatPage();
    }
    function getPage() 
    {
      return $this->page;
    }

}

class HtmlDirector extends AbstractHtmlDirector 
{
    private $builder = NULL;
    public function __construct(AbstractPageBuilder $builder_in) 
    {
         $this->builder = $builder_in;
    }
    public function buildPage() 
    {
      $this->builder->makeTitle('Test makeTitle');
      $this->builder->makeHeader('Test makeHeader');
      $this->builder->makeText('Test1');
      $this->builder->makeText('Test2');
      $this->builder->makeText('Test3');
      $this->builder->formatPage();
    }
    public function getPage() 
    {
      return $this->builder->getPage();
    }
}

$pageBuilder = new HtmlBuilder();
$pageDirector = new HtmlDirector($pageBuilder);
$pageDirector->buildPage();
$page = $pageDirector->GetPage();
writeln($page->showPage());
writeln('');

function writeln($line_in) 
{
  echo $line_in."<br/>";
}







?>