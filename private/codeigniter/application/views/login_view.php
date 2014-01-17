<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Login</title>
  </head>
  <body>
    <h1>Please log in:</h1>
    <?php echo validation_errors(); ?>
    <?php echo form_open('verifylogin'); ?>
	<table><tr><td>
      <label for="username">Username:</label>
	  </td><td>
      <input type="text" size="20" id="username" name="username"/>
      </td></tr>
	  <tr><td><br/>
      <label for="password">Password:</label>
	  </td><td>
      <input type="password" size="20" id="password" name="password"/>
      </td></tr>
	  <input type="hidden" name="controller" value="<?php if (isset($_GET['controller'])) echo $_GET['controller']; ?>">
	  <input type="hidden" name="title" value="<?php echo $_GET['title'] ?>">
	  <input type="hidden" name="group" value="<?php echo $_GET['group'] ?>">
      <tr><td><br/>
      <input type="submit" value="Login"/>
      </td></tr></table>
    </form>
  </body>
</html>
