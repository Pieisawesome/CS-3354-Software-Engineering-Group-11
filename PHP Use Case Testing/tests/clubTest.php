<?php
class ClubTest extends \PHPUnit\Framework\TestCase
{

    private $club1;
    private $club2;
    private $user1;
    private $user2;
    private $user3;

    protected function setUp() : void
    {
        // IEEE for addMember and ACM for addEvent
        $this -> club1 = new Club("IEEE");
        $this -> club2 = new Club("ACM");
        // Jane and John Doe are sample users for addUser tests
        $this -> user1 = new User("John Doe");
        $this -> user2 = new User("Jane Doe");
    }

    // -----------     Add Member Use Cases     ----------
    // Use case test when all inputs to add member are valid
    public function testAddMember1()
    {
        $this -> assertEquals("Member successfully created.", $this -> club1 -> addMember(0, ["President" , "Officer"]));
    }
    // Use case test when roles array is invalid (>5 roles)
    public function testAddMember2()
    {
        $this -> assertEquals("Roles must be limited to a maximum of 5.", $this -> club1 -> addMember(1, ["President", "Officer", "Programming", "Treasurer", "Vice President", "Instructor", "Engineering"]));
    }
    // Use case test when roles array is exceptional (role contains escape character)
    public function testAddMember3()
    {
        $this -> assertEquals("A role cannot contain escape characters.", $this -> club1 -> addMember(1,["\n"]));
    }
    // Use case test when roles array when ID is invalid (negative value)
    public function testAddMember4()
    {
        $this -> assertEquals("ID cannot be negative.", $this -> club1 -> addMember( -1 , [ "President" , "Officer" ]));
    }
    // Use case test when roles array when ID is exceptional (non-integer value)
    public function testAddMember5()
    {
        $this -> assertEquals("ID must be of integer type.", $this -> club1 -> addMember("\n", ["President", "Officer"]));
    }
    
    // -----------     Add Event Use Cases     ----------
    // Use case test when all inputs to add event are valid
    public function testAddEvent1()
    {
        $this -> assertEquals("Event successfully created.", $this -> club2 -> addEvent("Git Workshop", "2024-10-28", "Learn about Git here!"));
    }
    // Use case test when description input is invalid (empty description)
    public function testAddEvent2()
    {
        $this -> assertEquals("Cannot have an empty description.", $this -> club2 -> addEvent("React Workshop", "2024-10-28", ""));
    }
    // Use case test when description input is exceptional (escape character)
    public function testAddEvent3()
    {
        $this -> assertEquals("Description cannot contain escape characters.", $this -> club2 -> addEvent("React Workshop", "2024-10-28", "\n"));
    }
    // Use case test when date input is invalid (invalid format - contains non-numerical characters)
    public function testAddEvent4()
    {
        $this -> assertEquals("Invalid date format.", $this -> club2 -> addEvent("React Workshop", "abjd-js-qd", "Learn about React here!"));
    }
    // Use case test when date input is exceptional (contains illegal date value)
    public function testAddEvent5()
    {
        $this -> assertEquals("Illegal date value.", $this -> club2 -> addEvent("React Workshop", "2024-02-30", "Learn about React here!"));
    }
    // Use case test when title input is invalid (empty title)
    public function testAddEvent6()
    {
        $this -> assertEquals("Title cannot be empty.", $this -> club2 -> addEvent("", "2024-02-30", "Learn about React here!"));
    }
    // Use case test when title input is esceptional (escape character)
    public function testAddEvent7()
    {
        $this -> assertEquals("Title cannot contain escape characters.", $this -> club2 -> addEvent("\n", "2024-02-30", "Learn about React here!"));
    }
    
}
// To run: ./vendor/bin/phpunit
?>