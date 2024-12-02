<?php
namespace unitTesting;
use mysqli;

class EventSearcher
{
    private $mysqli;

    public function __construct(mysqli $mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function searchEvents(string $query): array
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM event WHERE name LIKE ?");
        $searchTerm = '%' . $query . '%';
        $stmt->bind_param('s', $searchTerm);
        $stmt->execute();

        $result = $stmt->get_result();
        $events = [];
        while ($row = $result->fetch_assoc()) {
            $events[] = $row;
        }

        $stmt->close();
        return $events;
    }
}
