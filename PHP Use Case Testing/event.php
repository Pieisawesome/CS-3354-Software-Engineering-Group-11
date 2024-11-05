<?php
class Event
{
    private $title;
    private $dateTime;
    private $description;

    public function __construct($title, $time, $description)
    {
        $this -> title = $title;
        $this -> dateTime = new DateTime($time);
        $this -> description = $description;
    }

    public function setTitle($newTitle)
    {
        $this -> title = $newTitle;
    }

    public function setDateTime($newTime)
    {
        $this -> dateTime = new DateTime($newTime);
    }

    public function setDescription($newDescription)
    {
        $this -> description = $newDescription;
    }

    public function getTitle()
    {
        return $this -> title;
    }

    public function getDate()
    {
        return $this -> dateTime;
    }

    public function getDescription()
    {
        return $this -> description;
    }
}
?>
