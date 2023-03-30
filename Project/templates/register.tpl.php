<?php declare(strict_types = 1); ?>

<?php function drawUserRegisterForm() { ?>
  <h2 class="title">Register User</h2>
  <form action="../actions/action_register_user.php" method="post" class="profile" enctype="multipart/form-data">
    <div>
      <label for="photo">Photo</label>
      <input id="photo" type="file" name="photo" accept=".png, .jpeg, .jpg">
      <small>Accepted formats: .png, .jpeg, .jpg</small>

      <label for="name">Name</label>
      <input id="name" type="text" name="name" placeholder="Name" required>
      
      <label for="username">Username</label>
      <input id="username" type="text" name="username" placeholder="Username" pattern="[a-zA-Z][a-zA-Z0-9-_.]{2,11}" maxLength="12" required> 
      <small>Allowed: a-Z, 0-9, hyphens, underscores and periods (between 3 to 12 characters). Must begin with a letter</small>
      
      <label for="password">Password</label>
      <input id="password" type="password" name="password" pattern="[a-zA-Z0-9-_.]{6,16}" maxLength="20" placeholder="Password" required>
      <small>Allowed: a-Z, 0-9, hyphens, underscores and periods (between 6 to 16 characters)</small>
      
      <label for="address">Address</label>
      <input id="address" type="text" name="address" placeholder="Address" required>

      <label for="email">E-mail</label>
      <input id="email" type="email" name="email" placeholder="E-mail" required>

      <label for="phone">Phone number</label>
      <input id="phone" type="text" name="phone" placeholder="Phone number" pattern="\d{9}$" required>
      
      <label for="option">User type</label>
      <select id="option" name="option" required>
        <option value="customer">Customer</option>
        <option value="owner">Restaurant owner</option>
      </select>
      
      <button type="submit">Register</button>
    </div>
  </form>
<?php } ?>

<?php function drawRestaurantRegisterForm() { ?>
  <h2 class="title">Add Restaurant</h2>
  <form action="../actions/action_add_restaurant.php" method="post" class="profile" enctype="multipart/form-data">
    <div>

      <label for="photo">Photo</label>
      <input id="photo" type="file" name="photo" accept=".png, .jpeg, .jpg">
      <small>Accepted formats: .png, .jpeg, .jpg</small>

      <label for="name">Name</label>
      <input id="name" type="text" name="name" placeholder="Name" required>

      <label for="address">Address</label>
      <input id="address" type="text" name="address" placeholder="Address" required>

      <label for="category">Category</label>
      <select id="categorys" name="category" required>
        <option value="" selected disabled hidden>Choose a category</option>
        <option value="Italian">Italian</option>
        <option value="Japanese">Japanese</option>
        <option value="Chinese">Chinese</option>
        <option value="Traditional">Traditional</option>
        <option value="American">American</option>
        <option value="Mexican">Mexican</option>
        <option value="Other">Other</option>
      </select>
      <button type="submit">Register</button>
    </div>
  </form>
<?php } ?>

<?php function drawDishRegisterForm(int $restaurantId) { ?>
  <h2 class="title">Add Dish</h2>
  <form action="../actions/action_add_dish.php?id=<?=$restaurantId?>" method="post" class="profile" enctype="multipart/form-data">
    <div>
      <label style="color: black" for="photo">Photo</label>
      <input id="photo" type="file" name="photo" accept=".png, .jpeg, .jpg">
      <small>Accepted formats: .png, .jpeg, .jpg</small>

      <label style="color: black" for="name">Name</label>
      <input id="name" type="text" name="name" placeholder="Name" required>

      <label style="color: black" for="price">Price</label>
      <input id="price" type="text" name="price" placeholder="Price" pattern="^\d{0,4}(\.\d{1,2})" required>
      <small>Format: XX.YY</small>

      <label style="color: black" for="description">Description</label>
      <input id="description" type="text" name="description" maxlength="50" placeholder="Description" required> 
      <small>Max. 50 characters</small>

      <label style="color: black" for="category">Category</label>
        <select id="category" name="category">
          <option value="" selected hidden>Choose a category</option>
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
    </div>
  </form>
<?php } ?>
