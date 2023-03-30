<?php declare(strict_types = 1); ?>

<?php function drawProfileForm(User $user) { ?>
<h2 class="title">User Profile</h2>
<form action="../actions/action_edit_profile.php" method="post" class="profile" enctype="multipart/form-data">

  <label for="photo">Photo</label>
  <input id="photo" type="file" name="photo" accept=".png, .jpeg, .jpg">
  <small>Accepted formats: .png, .jpeg, .jpg</small>

  <label for="name">Name</label>
  <input id="name" type="text" name="name" value="<?=$user->name?>">
  
  <label for="username">Username</label>
  <input id="username" type="text" name="username" value="<?=$user->username?>" maxLength="12" pattern="[a-zA-Z][a-zA-Z0-9-_.]{2,11}"> 
  <small>Allowed: a-Z, 0-9, hyphens, underscores and periods (between 3 to 12 characters). Must begin with a letter</small>

  <label for="password">Password</label>
  <input id="password" type="password" name="password" pattern="[a-zA-Z0-9-_.]{6,16}">
  <small>Allowed: a-Z, 0-9, hyphens, underscores and periods (between 6 to 16 characters)</small>
  
  <label for="address">Address</label>
  <input id="address" type="text" name="address" value="<?=$user->address?>">

  <label for="email">E-mail</label>
  <input id="email" type="email" name="email" value="<?=$user->email?>">

  <label for="phone">Phone number</label>
  <input id="phone" type="text" name="phone" value="<?=$user->phone?>" pattern="\d{9}$">
  
  <button type="submit">Save</button>
</form>
<?php } ?>