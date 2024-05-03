<?php
class ModuleRunner
{
    private $configData;

    public function __construct($configData)
    {
        $this->configData = $configData;
    }

    private $modules;

    /**
     * @throws ReflectionException
     * @throws Exception
     */
    function init()
    {
        $interface = new ReflectionClass('Module');
        foreach ( $this -> configData as $modulename => $params ){
            $thisModule = new ReflectionClass( $modulename );
            if( ! $thisModule -> isSubclassOf($interface)){
                throw new Exception("Unkown module type : $modulename");
            }

            $module = $thisModule -> newInstance();

            foreach( $thisModule -> getMethods() as $method ) {
                $this -> handleMethod($module , $method , $params);
            }
            $this->modules[] = $module;
        }
    }

    /**
     * @throws ReflectionException
     */
    function handleMethod(Module $module , ReflectionMethod $method, $params ){
        $name = $method -> getName();
        $args = $method -> getParameters();

        if(count($args) != 1 || substr($name,0,3) != 'set'){
            return false;
        }

        $property = strtolower(substr($name,3));

        if(!isset($params[$property])){
            return false;
        }

        $arg_class = $args[0] -> getClass();

        if(empty($arg_class)){
            $method -> invoke($module , $params[$property]);
        }else{
            $method -> invoke($module , $arg_class -> newInstance($params[$property]));
        }

        return true;
    }
}

