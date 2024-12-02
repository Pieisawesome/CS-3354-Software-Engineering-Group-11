<?php
namespace CS3354Project\Tests;

use PHPUnit\Framework\TestCase;
use mysqli;
use mysqli_result;
use mysqli_stmt;
use CS3354Project\EventSearcher;

class EventSearcherTest extends TestCase {
    private $mockConn;

    protected function setUp(): void {
        // Create a mock for the mysqli class
        $this->mockConn = $this->createMock(mysqli::class);

        // Set up a mock query result
        $mockResult = $this->createMock(mysqli_result::class);
        $mockResult->method('fetch_assoc')->willReturnOnConsecutiveCalls(
            ['id' => 1, 'name' => 'Event 1', 'date' => '2024-01-01', 'time' => '12:00', 'location' => 'Location A', 'info' => 'Details of Event 1'],
            ['id' => 2, 'name' => 'Event 2', 'date' => '2024-02-01', 'time' => '14:00', 'location' => 'Location B', 'info' => 'Details of Event 2'],
            null
        );

        // Mock the query method to return the mock result
        $this->mockConn->method('query')->willReturn($mockResult);
    }

    public function testSearchEvents()
{
    // Mock the mysqli_result object
    $mockResult = $this->createMock(mysqli_result::class);

    // Configure fetch_assoc to return results and then null
    $mockResult->method('fetch_assoc')
               ->willReturnOnConsecutiveCalls(
                   ['name' => 'Event 1', 'date' => '2023-01-01', 'time' => '10:00', 'location' => 'Location 1', 'info' => 'Details 1'],
                   ['name' => 'Event 2', 'date' => '2023-01-02', 'time' => '11:00', 'location' => 'Location 2', 'info' => 'Details 2'],
                   null
               );

    // Mock the mysqli_stmt object
    $mockStmt = $this->createMock(mysqli_stmt::class);

    // Configure bind_param and execute to do nothing (no exceptions)
    $mockStmt->method('bind_param')->willReturn(true);
    $mockStmt->method('execute')->willReturn(true);

    // Configure get_result to return the mocked result object
    $mockStmt->method('get_result')->willReturn($mockResult);

    // Mock the mysqli object
    $mockMysqli = $this->createMock(mysqli::class);

    // Configure prepare() to return the mocked statement object
    $mockMysqli->method('prepare')->willReturn($mockStmt);

    // Create an instance of EventSearcher and pass the mocked mysqli object
    $searcher = new EventSearcher($mockMysqli);

    // Call the search method and assert the output
    $searchResults = $searcher->searchEvents('Event');
    $this->assertCount(2, $searchResults);
    $this->assertEquals('Event 1', $searchResults[0]['name']);
    $this->assertEquals('Event 2', $searchResults[1]['name']);
}

    

public function testSearchEventsNoResults()
{
    // Mock the mysqli_result object
    $mockResult = $this->createMock(mysqli_result::class);

    // Configure fetch_assoc to immediately return null (no rows)
    $mockResult->method('fetch_assoc')->willReturn(null);

    // Mock the mysqli_stmt object
    $mockStmt = $this->createMock(mysqli_stmt::class);

    // Configure bind_param and execute to do nothing (no exceptions)
    $mockStmt->method('bind_param')->willReturn(true);
    $mockStmt->method('execute')->willReturn(true);

    // Configure get_result to return the mocked result object
    $mockStmt->method('get_result')->willReturn($mockResult);

    // Mock the mysqli object
    $mockMysqli = $this->createMock(mysqli::class);

    // Configure prepare() to return the mocked statement object
    $mockMysqli->method('prepare')->willReturn($mockStmt);

    // Create an instance of EventSearcher and pass the mocked mysqli object
    $searcher = new EventSearcher($mockMysqli);

    // Call the search method and assert the output
    $searchResults = $searcher->searchEvents('Nonexistent Event');
    $this->assertCount(0, $searchResults); // Expect no results
}


}
