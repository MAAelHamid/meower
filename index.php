<?php 
  // ini_set('display_errors', 1);
  // ini_set('display_startup_errors', 1);
  // error_reporting(E_ALL);
  include 'connect.php';
  // Force URL change in address bar
  $URI = $_SERVER['REQUEST_URI'];
  if(!empty($_POST)){
    header("location:$URI");
  }
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    empty($name) ? $name = "anonymous": 0;
    $content = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
    // insert data to DB
    $InsertCont = $con -> prepare("INSERT INTO mews(name, content) VALUES (?, ?)");
    $InsertCont -> execute(array($name, $content));
  }
  // fetch data
  $allContent = $con -> prepare("SELECT * FROM mews ORDER BY time DESC");
  $allContent -> execute();
  $tweets = $allContent -> fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Meower - Twitter for Cats 😸</title>
  <link rel="icon" href="img/favicon.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/skeleton/2.0.4/skeleton.min.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito&display=swap">
  <link rel="stylesheet" href="style.css">
</head>

<body style="font-family: 'Nunito', sans-serif;">
  <!-- main app -->
  <div class="main">
    <header>
      <h1 class="title">Meower - Twitter for Cats 😸</h1>
    </header>
    <main>
      <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" class="mew-form">
        <label for="name">Name</label>
        <input class="u-full-width" type="text" id="name" name="name">
        <label for="content">Mew</label>
        <textarea class="u-full-width" type="text" id="content" name="content"></textarea>
        <button class="button-primary" onclick="empty()">Send your Mew 😽</button>
      </form>
    </main>
    <div class="loading" style="display: none;">
      <img src="img\Spinner-0.5s-101px.gif" alt="">
    </div>    
  </div>

  <!-- tweets -->
  <div class="tweets">
    <?php
    if (!empty($tweets)) {
      foreach($tweets as $tweet) {
        echo '<div class="tweet">';
        echo '<h5>'.$tweet['name'].'</h5>';
        echo '<p>'.$tweet['content'].'</p>';
        echo '<div>'.$tweet['time'].'</div>';
        echo '</div>';
      }
    }
    // clearing $_POST
    $_POST = array();
    ?>
  </div>
  <script src="index.js"></script>
</body>
</html>
