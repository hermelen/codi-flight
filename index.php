<?php require "settings.php"; ?>
<?php require "pdo.php"; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title></title>
  </head>
  <body>
    <div class="container">
      <h1 class="text-center">Codi Flights:</h1>
      <form class="text-center" action="index.php" method="post">
        <select class="" name="departure">
          <?php foreach ($airports as $airport) { ?>
            <option value="<?php echo $airport['code'] ?>"><?php echo $airport['city'] ?></option>
          <?php } ?>
        </select>
        <input type="submit" name="submit" value="Valider">
      </form>
      <div class="row">
        <?php
        // print_r($flights);
        foreach ($flights as $flight) {
          $string_departure_date = $flight['departure_date'];
          $departure_date = date_create_from_format('Y-m-d H:i:s', $string_departure_date);
          $departure_timestamp = $departure_date->getTimestamp();
          $departure = new DateTime($string_departure_date);

          $string_arrival_date = $flight['arrival_date'];
          $arrival_date = date_create_from_format('Y-m-d H:i:s', $string_arrival_date);
          $arrival_timestamp = $arrival_date->getTimestamp();
          $arrival = new DateTime($string_arrival_date);

          $interval = date_diff($departure, $arrival);
          ?>
          <div class="card col-12 col-sm-6 col-md-4 col-lg-3" style="width: 18rem;">
            <img class="card-img-top" src="https://picsum.photos/200/150/?random" alt="Card image cap">
            <!-- <div id="map"></div> -->
            <div class="card-body">
              <h5 class="card-title">Vol: <?php echo $flight['code'] ?></h5>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Départ:</li>
              <li class="list-group-item"><?php echo $flight['from_airport_city']; ?> le <?php echo date('d/m/Y à H:i:s', $departure_timestamp) ?></li>
              <li class="list-group-item">Arrivée:</li>
              <li class="list-group-item"><?php echo $flight['to_airport_city'] ?> le <?php echo date('d/m/Y à H:i:s', $arrival_timestamp) ?></li>
              <li class="list-group-item">Temps de vol: <?php echo $interval->format("%H:%I:%S"); ?></li>
            </ul>
          </div>
        <?php } ?>
      </div>
    </div>
    <script src="script.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgzP29U0B-0zVIz25UsKwFSQPFXixrh0I&callback=initMap"></script>
  </body>
</html>
