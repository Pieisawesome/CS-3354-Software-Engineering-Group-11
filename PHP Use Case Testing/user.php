<?php
include_once 'club.php';

    class User
    {
        private $name;
        private $ID;
        private $clubsList = [];

        private static $IDCount = 1;
        private static $userMap = [];

        public function __construct($name)
        {
            $this -> name = strtoupper($name);
            $this -> ID = self :: $IDCount;
            self :: $IDCount++;
            self :: $userMap[$this -> ID] = $this;
        }

        public function addClub($club)
        {
            $this -> clubsList[] = $club;
        }

        public function removeClub($club)
        {
            $this -> clubsList = array_values(array_filter($this -> clubsList, function ($c) use ($club) {
                return $c !== $club;
            }));
        }

        public function getClubsList()
        {
            return $this -> clubsList;
        }
   
        public function getName() {
            return $this -> name;
        }
   
        public function getID() {
            return $this -> ID;
        }

        public static function getUserID($ID)
        {
            return self :: $userMap[$ID];
        }

    }
?>
