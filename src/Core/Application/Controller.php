<?php

namespace Effernet\Core\Application;

class Controller{
    /**
     * Variable holds the layout to be used
     * @var string pre-defined value : 'main'
     */
    public string $layout = 'main';

    /**
     * @param string $view <p>
     * To render the php file at [/Application/Views/$view.php], it must have a filename equal to $view.
     * <br>Example Uses:<br> [render('home', $data);] or [render('User/edit', $data);] >br> As seen in the second use,
     * saying [User/edit] It calls edit.php under the [User] folder.</p>
     * @param array $params <p>
     * [Optional] Sends all the data to be sent on the view page to the page. Gets the name
     * of the first value in the data sent. For example : $params = [ 'key' => 'value']; <br>
     * echo $key; (screen output : [value]) </p>
     * @link http://framework.kadirsanel.com/doc/core/Controller/ */
    public function render(string $view, array $params = []){
        echo Run::$run->router->renderView($view, $params);
    }

    /** Selecting the other layouts added inside the [/Application/Views/Layout] folder, it assigns the $this->layout
     * variable to the desired value from the 'main' definition to print the content part to the desired layout.
     * @param string $layout <p>Variable holding the value that will change with the value inside [$this->layout]</p>
     * @link http://framework.automatic-audit.com/doc/core/Controller/ */
    public function setLayout(string $layout){
        $this->layout = $layout;
    }
}