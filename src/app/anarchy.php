<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

function uploadAnarachy(&$msg) {
    $file_info = pathinfo($_FILES['fileToUpload']['name']);

    // Let's check the file extension
    $extension = $file_info['extension'];
    if (in_array(strtolower($extension), ['jpg', 'jpeg', 'gif', 'png']) === false) {
        $msg = 'Only jpg, jpeg, gif, or png extensions allowed !';
        return false;
    }

    // ... and is it really an image ?
    if (getimagesize($_FILES['fileToUpload']['tmp_name']) === false) {
        $msg = 'Not really an image, huh ? We are anarchists, not idiots.';
        return false;
    }

    // TODO encrypt file content to fight governments and VIM users
    // ... should be done before we save the uploaded file ...

    // We save the file to the anarchy folder
    $dest = __DIR__ . '/chaos/' . uniqid('anon_', true) . '_' . $file_info['filename'];
    if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $dest))
        return $dest;

    $msg = 'Could not save the file. Contact the administrator !';
}

if (isset($_POST) && isset($_FILES) && isset($_FILES['fileToUpload'])) {
    $msg = '';
    $uploaded = uploadAnarachy($msg);
}

?>

<?php include('includes/header.php'); ?>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="/">PHAR</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><a href="/app">Home</a></li>
              <li class="active"><a href="/app/anarchy.php">Anarchy</a></li>
              <li><a href="/app/security.php">Security</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>


        <div class="container marketing">

          <!-- Three columns of text below the carousel -->
          <div class="row">
            <div class="span4" style="margin-left:50px;">
              <img class="img-circle" data-src="holder.js/140x140">
              <h2>What's this ?</h2>
              <p>Send us your private photos and we'll keep them for you. Don't ask why, we will use them later for a greater purpose.</p>
            </div><!-- /.span4 -->

            <div class="span6">
              <div class="jumbotron" style="margin-top: -50px;">
                <h1 style="font-size: 40px;">$> Upload now</h1>
                <br>

                <form method="post" enctype="multipart/form-data">
                  <p><a class="btn" onclick="$('#fileToUpload').trigger('click'); return false;">Select file</a></p>
                  <input type="file" name="fileToUpload" id="fileToUpload" onchange="$('#selectedFile').html($('#fileToUpload').val());" style="display:none">
                  <p id="selectedFile">No file selected.</p>
                  <input type="submit" class="btn" value="Upload Image" name="submit">
                </form>
              </div>

            </div><!-- /.span6 -->
          </div><!-- /.row -->


          <div class="row">
            <div class="span10" style="margin-left:100px;">
              <?php if (!empty($msg)): ?>
              <p>Error : <span class="label label-important"><?= $msg ?></span></p>
            </div>
            <?php endif; ?>
              <?php if (!empty($uploaded)): ?>
              <p>Saved to <span class="label label-success"><?= $uploaded ?></span>
                <br>
                Your files now belong to us.
              </p>
            </div>
            <?php endif; ?>
          </div>


<?php include('includes/footer.php'); ?>
