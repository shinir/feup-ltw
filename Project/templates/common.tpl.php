<?php 
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  error_reporting(0);
?>

<?php function drawHeader(Session $session) { ?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>Eats</title>
    <link rel = "icon" href = "../photos/site/whitelogo.png" type = "image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/dishes.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/order.css"> 
    <link rel="stylesheet" href="../css/profiles.css">  
    <link rel="stylesheet" href="../css/restaurant.css">  
    <link rel="stylesheet" href="../css/register.css"> 
    <link rel="stylesheet" href="../css/reviews.css">  
    <link rel="stylesheet" href="../css/sidebar.css">  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../javascript/buyscript.js" defer></script>
    <script src="../javascript/favorite.js" defer></script>
    <script src="../javascript/sort.js" defer></script>
  </head>
  <body>
    <header class="header">
      <img src="../photos/site/whitelogo.png" class="logo">
      <h1 class="pagetitle"><a href="../pages/index.php">Let's Eat</a></h1>
      <h4 class="catch">Where hungry is a thing of the past!</h4>
    </header>
    <section id="messages">
      <?php foreach ($session->getMessages() as $messsage) { ?>
        <article class="<?=$messsage['type']?>">
          <?=$messsage['text']?>
        </article>
      <?php } ?>
    </section>
  
    <main>
    <?php 
        if ($session->isLoggedIn())
        {
          drawLogoutForm($session);
          drawSidebar($session);
        } 
        else drawLoginForm($session);
    ?>
<?php } ?>

<?php function drawFooter() { ?>
    </main>

    <footer>
      <div>
        <h3 id="foot">Let's Eat &copy; <?php echo date("Y");?></h3>
      </div>
    </footer>
  </body>
</html>
<?php } ?>

<?php function drawLoginForm() { ?>
  <a href="../pages/register_profile.php" class="register">Register</a> 
  <a href="../pages/login.php" class="loginbut">Login</a> 
<?php } ?>

<?php function drawLogoutForm(Session $session) { ?>
  <form action="../actions/action_logout.php" method="post" class="logout">
    <button type="submit">Logout</button>
  </form>
<?php } ?>

<?php function drawSearchBar() { ?>
  <header>
    <form id="searchform" action="../actions/action_search_restaurant.php" method="post" class="search">
      <input id="searchrestaurants" type="text" name="name" placeholder="Search" required>
      <button form="searchform" id="searchbutton" type="submit" formmethod="post"><i class="fa fa-search"></i></button>
    </form>
    <script>
    var input = document.getElementById("searchrestaurants");
    input.addEventListener("keypress", function(event) {
      if (event.key === "Enter") {
        event.preventDefault();
        document.getElementById("searchbutton").click();
      }
    });
  </script>
<?php } ?>

<?php function drawSidebar(Session $session) { ?>
  <div id="mySidebar" class="sidebar">
    <nav class="menu">
      <ul>
        <li id="user">
          <img class="userphoto" src=<?=$session->getImagePath()?> alt="Profile picture" width=50 height=50>
          <p class ="username"><?=$session->getName()?> </p>
        </li>
        <li><a href="../pages/profile.php">Profile</a></li>
        <li><a href="../pages/checkout.php">Orders</a></li>
        <?php if($session->isOwner()): ?>
          <li><a href="../pages/owner_restaurants.php">Restaurants</a></li>
        <?php endif; ?>
        <li><a href="#">&#128722;</a></li>
        <li><a>Shopping Cart</a></li>
        <li>
          <section id="cart">
            <table id="carttable">
              <thead>
                <tr class="cartvalues">
                  <th>Prod</th>
                  <th>Quant</th>
                  <th>Price</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th colspan="4">Total:</th>
                  <th>0</th>
                </tr>
              </tfoot>
            </table>
          </section>
        </li>
        <a><button class="checkoutbutton" type="button" onclick="SaveItems()">Checkout</button></a>
        <li><a href="javascript:void(0)" class="closebar" onclick="closeNav()">×</a></li>
      </ul>
    </nav>      
    
  </div>


  <div id="main">
    <button id="buttonsidebar" class="openbar" onclick="openNav()">☰</button>  
  </div>

  <script>
    function openNav() {
      document.getElementById("mySidebar").style.width = "350px";
      document.getElementById("main").style.marginLeft = "350px";
      document.getElementById("buttonsidebar").style.visibility = "hidden";
    }

    function closeNav() {
      document.getElementById("mySidebar").style.width = "0";
      document.getElementById("main").style.marginLeft= "0";
      document.getElementById("buttonsidebar").style.visibility = "visible";
    }
  </script>
<?php } ?>
