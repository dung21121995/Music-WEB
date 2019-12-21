<?php
class App{

    protected $controller="Home";
    protected $action="Sayhi";
    protected $params=[];

    function __construct(){
        $arr= $this->UrlProcess();
        

        //Process controller
        if (file_exists("./mvc/controllers/".$arr[0].".php")) {
            # code...
           $this->controller=$arr[0];
           unset($arr[0]);
        }
        require_once "./mvc/controllers/".$this->controller.".php";
        $this->controller= new $this->controller;

        //Process Action
        if (isset($arr[1])) {
            # code...
            if (method_exists($this->controller,$arr[1])){
                # code...
                $this->action=$arr[1];
                
            }
            unset($arr[1]);
        }
       


        //Process Params
        $this->params=$arr ? array_values($arr):[];
       

        call_user_func_array([$this->controller,$this->action],$this->params);
    }

    public function UrlProcess(){
        if (isset($_GET["url"])) {
            # code...
           return  explode("/",filter_var(trim($_GET["url"],"/")));
          
        }
     
    }
}
?>