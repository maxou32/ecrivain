<?php


class View
{

    protected $template;
    protected $params;


    public function __construct($template)
    {
        $this->template = $template;
    }

    public function renderTemplate()
    {

        foreach ($this->params as $name => $value)
        {
            ${$name} = $value; //extract($params) array('message' => 'hello world'); => $message = "hello word';
        };
        ob_start();
        include_once (VIEW.$this->template.'.php');
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