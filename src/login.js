<script type="text/javascript" 
    src="http://code.jquery.com/jquery.js"></script>
<script type="text/javascript" src="register.js"></script>
<div id="container">
  <div id="message"></div>
  <form method="post" id="mainform">
    <label for="username">Username</label>
    <input type="text" name="username" id="username" value="" />

    <label for="password">Password</label>
    <input type="password" name="password" value="" />

    <input type="submit" name="action" id="login" value="Log in" />

    <h2>Extra options (registration only)</h2>

    <label for="firstname">First name</label>
    <input type="text" name="firstname" value="" />

    <label for="lastname">Last name</label>
    <input type="text" name="lastname" value="" />

    <label for="email">Email</label>
    <input type="text" name="email" value="" />

    <input type="submit" name="action" id="register" value="Register" />
  </form>
</div>