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

    // Use Case 1 - addMember (addID integer input, roles string array input)
    public function addMember($addID, array $roles)
    {
        // Iterates through each bucket of the memberRoles map and checks if the ID's match
        foreach ($this -> memberRolesMap as $member => $rolesList) 
        {
            // Cannot add an existing user to the club
            if ($member == $addID) 
                return "Cannot add, user with same ID already exists.";
        }
        // Checks if the $addID input is of integer type
        if(!is_int($addID))
            return "ID must be of integer type.";
        // ID cannot be negative
        if($addID < 0)
            return "ID cannot be negative.";

        // Cannot have more than 5 roles
        if(count($roles) > 5)
            return "Roles must be limited to a maximum of 5.";
        // Iterates through the roles array
        foreach($roles as $role)
        {
            // Role length cannot exceed 15 characters
            if(strlen($role) > 15)
                return "Each role must be a maximum of 15 characters.";
            // A role cannot be empty
            if(strlen($role) == 0)
                return "A role cannot be empty.";
            // Regex to check whether a role contains escape characters
            if(preg_match('/[\\x00-\\x1F\\x7F]/', $role))
                return "A role cannot contain escape characters.";
        }

        // Finds corresponding User object
        $user = User :: getUserID($addID); 
        // User added as member to memberRolesMap with addID as key and roles list as value
        $this -> memberRolesMap[$addID] = $roles; 
        // User's club list updated with new club membership
        $user -> addClub($this); 
        return "Member successfully created.";
    }

    public function removeMember($removalID)     
    {
        $user = null;
        foreach ($this -> memberRolesMap as $member => $rolesList) 
        {
            if ($member -> getID() === $removalID) 
            {
                $user = $member;
                break;
            }
        }
    
        if (!$user) 
            return "Cannot remove, User ID not found.";
    
        $this -> memberRolesMap = array_values(array_filter($this->memberRolesMap, function ($member) use ($removalID) 
        {
            return $member -> getID() !== $removalID;
        }));
    
        $user -> removeClub($this);
    }

    // Use Case 2 - addEvent (title, description string inputs; time should be string input in DateTime format)
    public function addEvent($title, $time, $description)
    {
        // Checks if event already exists in the club
        foreach ($this -> eventList as $event) 
        {
            if ($event -> getTitle() === $title) 
                return "Cannot add, event with same name already exists.";
        }

        // Title can't be 0 characters
        if(strlen($title) == 0)
            return "Title cannot be empty.";
        // Regex to check if title contains escape characters
        if(preg_match('/[\\x00-\\x1F\\x7F]/', $title))
            return "Title cannot contain escape characters.";
        // Title can't be longer than 50 characters
        if(strlen($title) > 50)
            return "Title cannot exceed 50 characters length.";

        // Description cannot be empty
        if(strlen($description) == 0)
            return "Cannot have an empty description.";
        // Regex to check if description contains escape characters
        if(preg_match('/[\\x00-\\x1F\\x7F]/', $description))
            return "Description cannot contain escape characters.";
        // Description can't be longer than 50 characters
        if(strlen($description) > 250)
            return "Description cannot be longer than 250 characters.";   

        // Checks if $time input is in the correct date format
        if (!strtotime($time)) 
            return "Invalid date format.";
        // Checks if input $time has the same value as the formatted object (legal values)
        $valTest = DateTime::createFromFormat('Y-m-d', $time);
        if(!($valTest && $valTest -> format('Y-m-d') === $time))
            return "Illegal date value.";

        // Creates an event object and adds it to the list
        $this -> eventList[] = new Event($title, $time, $description);
        return "Event successfully created.";
    }

    public function editEvent($title, $newTitle = null, $newTime = null, $newDescription = null)
    {
        foreach ($this -> eventList as $event) 
        {
            if ($event -> getTitle() === $title) 
            {
                if ($newTitle !== null && $newTitle !== $event -> getTitle()) 
                {
                    foreach ($this -> eventList as $event2) 
                    {
                        if ($event2 -> getTitle() === $newTitle) 
                            return "Cannot edit, event with same name already exists.";
                    }
                    $event -> setTitle($newTitle);
                }
                if ($newTime !== null) 
                {
                    if (!strtotime($newTime)) 
                        return "Invalid date format.";
                    $event -> setDateTime($newTime);
                }
                if ($newDescription !== null) 
                    $event -> setDescription($newDescription);
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
            $this -> eventList = array_values(array_filter($this -> eventList, function ($event) use ($title) 
            {
                return $event -> getTitle() !== $title;
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
