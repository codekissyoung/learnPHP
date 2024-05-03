<?php
class ModuleFtp implements Module {

    public function setHost($host)
    {
        print __CLASS__."_".__METHOD__." :: $host\n";
    }

    public function setUser($user)
    {
        print __CLASS__."_".__METHOD__." :: $user\n";
    }

    public function execute()
    {
        // TODO: Implement execute() method.
    }

}

