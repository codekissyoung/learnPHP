<?php
class ModulePerson implements Module {

    public function setPerson(Person $person)
    {
        print __CLASS__."_".__METHOD__."$person->name\n";
    }

    public function execute()
    {
        // TODO: Implement execute() method.
    }

}