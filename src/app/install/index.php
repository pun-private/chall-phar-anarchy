<?php

require_once __DIR__ . '/../includes/classes/Anarchy.php';

class ChaosManager extends Anarchy {

    public function getManifest() {
        return  "The first human beings possessed only tiny traces of our " .
                "capacity for logical thinking and critical judgment, which " .
                "generally, even today, is still very incomplete. For them " .
                "there was no difference, after all, between what appeared " .
                "in their minds as concepts and what they could grasp with " .
                "their hands. The one appeared as real to them as the other.";
    }

    static public function getDBConn($host, $login, $password) {
        return new mysqli($host, $login, $password);
    }
}

if (isset($_GET['type'])) {
    if (filter_var(@$_GET['ip'], FILTER_VALIDATE_IP) === false) {
      $msg  = "<div class='alert alert-error'>IP address is not valid !</div>";
      goto FK_LOGIC;
    }

    // not needed anymore
    // mysqli_options(MYSQLI_OPT_LOCAL_INFILE, true);
    $mysqli = ChaosManager::getDBConn(@$_GET['ip'], @$_GET['login'], @$_GET['password']));
    if ($mysqli->connect_error) {
        $msg  = "<div class='alert alert-error'>";
        $msg .= "Total Anarchy ! Unable to connect to MySQL.<br><br>";
        $msg .= "Errno: " . mysqli_connect_errno() . "<br>";
        $msg .= "Errno: " . mysqli_connect_error() . "<br></div>";
    }
    else {
        $mysqli->query("SELECT version()");

        $msg = "Successful connection to MySQL.";
        mysqli_close($mysqli);
    }
}

FK_LOGIC:

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Install &middot; Test Database</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../../assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        border: 1px solid #e5e5e5;
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
    <link href="../../assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../../assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../../assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="../../assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="../../assets/ico/favicon.png">
  </head>

  <body>

    <div class="container">

      <form class="form-signin">
        <h2 class="form-signin-heading">Test MySQL connectivity</h2>
        <input type="text" class="input-block-level" name="ip" placeholder="IP address" value="127.0.0.1">
        <input type="text" class="input-block-level" name="login" placeholder="login" value="login">
        <input type="password" class="input-block-level" name="password" placeholder="password" value="password">
        <input type="hidden" name="type" value="test">
        <button class="btn btn-large btn-primary" type="submit">Test</button>
      </form>

      <?php if (isset($msg)): ?>
          <div class="hero-unit">
            <h1><?= $msg ?></h1>
          </div>
      <?php endif; ?>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../assets/js/jquery.js"></script>
    <script src="../../assets/js/bootstrap-transition.js"></script>
    <script src="../../assets/js/bootstrap-alert.js"></script>
    <script src="../../assets/js/bootstrap-modal.js"></script>
    <script src="../../assets/js/bootstrap-dropdown.js"></script>
    <script src="../../assets/js/bootstrap-scrollspy.js"></script>
    <script src="../../assets/js/bootstrap-tab.js"></script>
    <script src="../../assets/js/bootstrap-tooltip.js"></script>
    <script src="../../assets/js/bootstrap-popover.js"></script>
    <script src="../../assets/js/bootstrap-button.js"></script>
    <script src="../../assets/js/bootstrap-collapse.js"></script>
    <script src="../../assets/js/bootstrap-carousel.js"></script>
    <script src="../../assets/js/bootstrap-typeahead.js"></script>

  </body>
</html>
