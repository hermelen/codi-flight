<?php
$pdo = new PDO("mysql:host=".$hostName.";dbname=".$dbName, $user, $pass);

$airports = $pdo->query('SELECT * FROM airport')->fetchAll();

if (isset($_POST['departure'])) {
  $post_departure = $_POST['departure'];
  $flights = $pdo->prepare(
    'SELECT table_from_airport.city AS from_airport_city, table_to_airport.city AS to_airport_city, flight.*
    FROM flight

    LEFT JOIN airport AS table_from_airport
    ON table_from_airport.code = :post_departure

    LEFT JOIN airport AS table_to_airport
    ON flight.airport_to = table_to_airport.code

    WHERE airport_from = :post_departure

    ORDER BY departure_date
  ');
  $flights->bindParam(':post_departure', $post_departure);

  $flights->execute();
}
else {
  $flights = $pdo->query(
  'SELECT table_from_airport.city AS from_airport_city, table_to_airport.city AS to_airport_city, flight.*
  FROM flight

  LEFT JOIN airport AS table_from_airport
  ON flight.airport_from = table_from_airport.code

  LEFT JOIN airport AS table_to_airport
  ON flight.airport_to = table_to_airport.code

  ORDER BY departure_date
  ')->fetchAll();
}
