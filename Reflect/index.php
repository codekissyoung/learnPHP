<?php
require "./Person.php";
require "./Module.php";
require "./ModuleFtp.php";
require "./ModulePerson.php";
require "./ModuleRunner.php";

$m = new ModuleRunner([
    "ModulePerson"=>['person'=>"bob"],
    "ModuleFtp" => ["host"=>"example.com","user"=>"ann"]
]);

try {
    $m->init();
} catch (ReflectionException $e) {
    var_dump($e);
} catch (Exception $e) {
    var_dump($e);
}