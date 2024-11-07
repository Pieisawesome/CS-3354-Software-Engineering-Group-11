<?php
include_once 'user.php';
include_once 'event.php';

class Club
{
    private $clubName;
    private $memberRolesMap = [];
    private $eventList = [];

    public function __construct($clubName)
    {
        $this -> clubName = $clubName;
    }

    public function addMember($addID, array $roles)
    {
        foreach ($this -> memberRolesMap as $member => $rolesList) 
        {
            if ($member -> getID() === $addID) 
            {
                return "Cannot add, user with same ID already exists.";
            }
        }
        if($addID < 0)
            return "ID cannot be negative.";
        if(!is_int($addID))
            return "ID must be of integer type.";
        if(count($roles) > 5)
            return "Roles must be limited to a maximum of 5.";
        foreach($roles as $role)
        {
            if(strlen($role) > 15)
            {
                return "Each role must be a maximum of 15 characters.";
                break;
            }
        }
        $user = User :: getUserID($addID); 
        $this -> memberRolesMap[$user] = $roles; 
        $user -> addClub($this); 
    }

    public function removeMember($removalID)     
    {
        $user = null;
        foreach ($this -> memberRolesMap as $member => $rolesList) {
            if ($member -> getID() === $removalID) {
                $user = $member;
                break;
            }
        }
    
        if (!$user) {
            return "Cannot remove, User ID not found.";
        }
    
        $this->memberRolesMap = array_values(array_filter($this->memberRolesMap, function ($member) use ($removalID) {
            return $member -> getID() !== $removalID;
        }));
    
        $user -> removeClub($this);
    }

    public function addEvent($title, $time, $description)
    {
        foreach ($this->eventList as $event) 
        {
            if ($event->getTitle() === $title) 
            {
                return "Cannot add, event with same name already exists.";
            }

        }
        if(strlen($title) == 0)
        {
            return "Title cannot be empty.";
        }
        if(strlen($title) > 0)
            return "Title cannot exceed 50 characters length.";
        if (!strtotime($time)) 
        {
            throw new Exception("Invalid date time format.");
        }
        if(strlen($description) == 0)
            return "Cannot have an empty description.";
        if(strlen($description) > 250)
            return "Description cannot be longer than 250 characters.";
        $this->eventList[] = new Event($title, $time, $description);
    }

    public function editEvent($title, $newTitle = null, $newTime = null, $newDescription = null)
    {
        foreach ($this->eventList as $event) 
        {
            if ($event->getTitle() === $title) 
            {
                if ($newTitle !== null && $newTitle !== $event->getTitle()) 
                {
                    foreach ($this->eventList as $event2) 
                    {
                        if ($event2->getTitle() === $newTitle) 
                        {
                            return "Cannot edit, event with same name already exists.";
                        }
                    }
                    $event->setTitle($newTitle);
                }
                if ($newTime !== null) 
                {
                    if (!strtotime($newTime)) 
                    {
                        throw new Exception("Invalid date time format.");
                    }
                    $event->setDateTime($newTime);
                }
                if ($newDescription !== null) 
                {
                    $event->setDescription($newDescription);
                }
                return; 
            }
        }
        return "Cannot edit, event not found."; 
    }

    public function deleteEvent($title)
    {
        $exists = false; 
    
        foreach ($this -> eventList as $event) 
        {
            if ($event -> getTitle() === $title) 
            {
                $exists = true; 
                break; 
            }
        }
    
        if ($exists) 
        {
            $this->eventList = array_values(array_filter($this->eventList, function ($event) use ($title) {
                return $event->getTitle() !== $title;
            }));
        } 
        else 
        {
            return "Cannot delete, event not found.";
        }
    }

    public function getMemberRolesMap()
    {
        return $this -> memberRolesMap;
    }

    public function getEventList()
    {
        return $this -> eventList;
    }

    public function getName()
    {
        return $this -> clubName;
    }
}
?>
