<?php declare(strict_types = 1); ?>

<?php function drawUserLoginForm() { ?>
    <h2 class="title">Login</h2>
    <form action="../actions/action_login.php" method="post" class="profile" enctype="multipart/form-data">
        <div class="login">
            <label for="Username">Username</label>
            <input type="text" name="username" placeholder="username">
            <label for="Password">Password</label>
            <input type="password" name="password" placeholder="password">
            <button type="submit">Login</button>
        </div>
    </form>
<?php } ?>