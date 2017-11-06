<?php
  require 'library.php';

  if (!isset($_COOKIE["advisor"])) {
    redirect("advisorlogin.html");
  }
?>

<html lang="en">
<head>
  <title>SCU</title>
  <meta charset="utf-8"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>
  <header class="container">
    <div class="row">
      <h1 class="col-sm-16">
        <img src="https://upload.wikimedia.org/wikipedia/en/thumb/a/ad/Santa_Clara_U_Seal.svg/1024px-Santa_Clara_U_Seal.svg.png" height="60" width="60" alt="SCU-Seal">
        Santa Clara University
      </h1>
      <nav class="col-sm-4 text-right">
        <a class="btn btn-nav" href="index.html" role="button"><b>HOME</b></a>
        <a class="btn btn-nav" href="about.html" role="button"><b>ABOUT</b></a>
        <a class="btn btn-nav" href="contact.html" role="button"><b>CONTACT</b></a>
      </nav>
    </div>
  </header>

  <section class="jumbotron">
    <div class="tranbox">
      <div class="container">
        <?php
        require 'db_config.php';

        // Redirect user to login if cookie is not available
        if (!isset($_COOKIE["advisor"])) {
          redirect("advisorlogin.html");
        }

        // Connect to database
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
        if (! $conn) {
          die('Could not connect: ' . mysql_error());
        }

        // Get variables from form
        $ScuCourseAbbrv = $_POST['scucourseabbrv'];

        // TODO: Make sure capitalization and spacing doesn't matter
        // Display results from the table
        $sql = "SELECT * FROM Equivalencies WHERE scu_course_abbrv=\"".$ScuCourseAbbrv."\"";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          echo "<table>"; // TODO: <table style="width:90%"
          echo "<tr><th>Equivalency ID</th><th>SCU Course Name</th><th>SCU Course Abbreviation</th><th>Non-SCU University Name</th><th>Non-SCU Course Name</th><th>Non-SCU Course Abbreviation</th><th>Is it approved?</th><th>Notes</th></tr>";
          while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["equivalency_id"]."</td><td>".$row["scu_course_name"]."</td><td>".$row["scu_course_abbrv"]."</td><td>".$row["nonscu_university_name"]."</td><td>".$row["nonscu_course_name"]."</td><td>".$row["nonscu_course_abbrv"]."</td><td>".$row["approved"]."</td><td>".$row["notes"]."</td></tr>";
          }
          echo "</table>";
        }

        mysqli_close($conn);
        ?>
        <a class="btn btn-success" href="advisorhome.php">Back</a>
      </div>
    </div>
  </section>

  <footer class = "container">
    <div class="row">
      <p class="col-sm-4">
        &copy; 2017 Santa Clara University
      </p>
      <ul class="col-sm-8">
        <li class="col-sm-1">
          <a href="https://twitter.com/SantaClaraUniv?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor">
            <img src="https://s3.amazonaws.com/codecademy-content/projects/make-a-website/lesson-4/twitter.svg" alt="SCU Twitter">
          </a>
        </li>
        <li class="col-sm-1">
          <a href="https://www.facebook.com/SantaClaraUniversity/">
            <img src="https://s3.amazonaws.com/codecademy-content/projects/make-a-website/lesson-4/facebook.svg" alt="SCU Facebook">
          </a>
        </li>
        <li class="col-sm-1">
          <a href="https://www.instagram.com/santaclarauniversity/?hl=en">
            <img src="https://s3.amazonaws.com/codecademy-content/projects/make-a-website/lesson-4/instagram.svg" alt="SCU Instagram">
          </a>
        </li>
      </ul>
    </div>
  </footer>
</body>
</html>
