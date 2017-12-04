<?php
	namespace web_max\ecrivain;

class View
{

    protected $template;
    protected $params;


    public function __construct($template)
    {
        echo 'construct';
		$this->template = $template;
    }

    public function renderTemplate()
    {
		$maConfig=new Config();
        foreach ($this->params as $name => $value)
        {
            ${$name} = $value; //extract($params) array('message' => 'hello world'); => $message = "hello word';
        };
        ob_start();
        include_once ($maconfig->getDirView().$this->template.'.php');
        $html = ob_get_clean();
        return $html;
    }

    public function render($params = array())
    {

        $this->params = $params;
        $menu = $this->renderMenu();
        $content = $this->renderTemplate();
        include_once (VIEW.'_gabarit.php');
    }




}