<?php 
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../database/restaurant.class.php');
  require_once(__DIR__ . '/../database/dish.class.php');
  require_once(__DIR__ . '/../templates/review.tpl.php');
?>

<?php function drawDishCategories(Restaurant $restaurant, array $categories) { ?>
  </header>
  <h2 class="restdishes"><?=$restaurant->name?></h2>
  <a class="revscores">
    <?php drawReviewScore($restaurant) ?>
  </a>
  <section id="categories">
    <?php foreach($categories as $category) { ?>
      <a id="category" href="#<?=$category?>"><?=$category?></a>
    <?php } ?>
  </section>
<?php } ?>

<?php function drawDishesFromRestaurant(array $dishes, array $categories, ?array $favorites, Session $session, Restaurant $restaurant) { ?>
  <?php if(isset($favorites)): ?>
    <button id="favorites" onclick="showFavoriteDishes(<?=$restaurant->id?>)">Show Favorites</button>
  <?php endif; ?>

  <?php if($session->isLoggedIn() && $session->getId() === $restaurant->owner) : ?>
    <a class="dishadd" href="../pages/register_dish.php?id=<?=$restaurant->id?>">Add Dish</a>
  <?php endif; ?>

  <section id="dishes">
    <?php foreach($categories as $category) { ?>
        <h2 class="categoryname" id="<?=$category?>"><?=$category?></h2>
        <section class="dishp">
          <?php foreach ($dishes[$category] as $dish) { ?>
            <article data-id = "<?=$dish->id?>" class="dishinfo">
              <?php if($session->isLoggedIn() && $session->getId() === $restaurant->owner) : ?>
                <button class="dishedit"><a href="../pages/edit_dish.php?id=<?=$dish->id?>"><i class="fa fa-edit"></i></a></button>
                <button class="dishtrash"><a href="../actions/action_delete_dish.php?id=<?=$dish->id?>"><i class="fa fa-trash"></i></a></button>
              <?php endif; ?>

              <?php if(isset($favorites)): ?>
                <?php if(in_array($dish, $favorites)): ?>
                  <button onclick="dishFavorite(this, <?=$dish->id?>)" id="favorite">&#9733;</button>
                <?php else: ?>
                  <button onclick="dishFavorite(this, <?=$dish->id?>)" id="favorite">&#9734;</button>
                <?php endif; ?>
              <?php endif; ?>

              <img class="dishphoto" src="<?=$dish->photo?>">
              <span>Name: </span>
              <a class="dishname"><?=$dish->name?></a>
              <br>
              <span>Description: </span>
              <a class="description"><?=$dish->description?></a>
              <br>
              <span>Price: </span>
              <a class="price"><?=$dish->price?></a>
              <span>&euro;</span>
              <br>
              <input class="quantity" type="number" value="1">
              <button class="orderbutton">Order</button>
            </article>
          <?php } ?>
        </section>
    <?php } ?>
  </section>
  <script>
      prices = document.getElementsByClassName('price');
      for(var i = 0; i < prices.length; i++) {
        prices[i].textContent = parseFloat(prices[i].textContent, 10).toFixed(2);
      }
  </script>
<?php } ?>

<?php function drawDishForm(Dish $dish) { ?>
  <h2 class="title">Dish Info</h2>
  <form action="../actions/action_edit_dish.php?id=<?=$dish->id?>" method="post" class="dish" enctype="multipart/form-data">

    <label for="photo">Photo</label>
    <input id="photo" type="file" name="photo" accept=".png, .jpeg, .jpg">
    <small>Accepted formats: .png, .jpeg, .jpg</small>

    <label for="name">Name</label>
    <input id="name" type="text" name="name" placeholder="Name" value="<?=$dish->name?>">

    <label for="price">Price</label>
    <input id="price" type="text" name="price" placeholder="Price" pattern="^\d{0,4}(\.\d{1,2})" value="<?=$dish->price?>">
    <small>Format: XX.YY</small>

    <label for="description">Description</label>
    <input id="description" type="text" name="description" maxlength="50" placeholder="Description" value="<?=$dish->description?>"> 
    <small>Max. 50 characters</small>
    
    <label for="category">Category</label>
      <select id="categorys" name="category">
        <option value="<?=$dish->category?>" selected hidden><?=$dish->category?></option>
        <option value="Beef">Beef</option>
        <option value="Pork">Pork</option>
        <option value="Chicken">Chicken</option>
        <option value="Fish">Fish</option>
        <option value="Burger">Burger</option>
        <option value="Pizza">Pizza</option>
        <option value="Drink">Drink</option>
        <option value="Other">Other</option>
      </select>
    <button type="submit">Save</button>
  </form>
<?php } ?>