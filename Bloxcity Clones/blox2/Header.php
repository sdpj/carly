<?

include 'connection.php'

?>



<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Worldous</title>

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>                        

<nav class="navbar navbar-inverse">

  <div class="container-fluid">

    <div class="navbar-header">

      <a class="navbar-brand" href="#">Worldous</a>

    </div>

    <ul class="nav navbar-nav">

      <li class="active"><a href="#">Home</a></li>

      <li><a href="#">Users</a></li>

      <li><a href="#">Store</a></li>

      <li><a href="#">Forum</a></li>

      </li>

 </ul>

<?

if ($User) {

	echo "

    <ul class='nav navbar-nav navbar-right'>

  <li class='dropdown'>

<a class='dropdown-toggle' data-toggle='dropdown' href='#'>$User     

<span class='caret'></span></a>

        <ul class='dropdown-menu'>

          <li><a href='#'>Account</a></li>

          <li><a href='#'>Character</a></li>

          <li><a href='#'>Inbox</a></li>

<li class='divider'></li>

<li><a href='#'>Logout</a></li>



										";

									

									}

									else {

									

										echo "

<ul class='nav navbar-nav navbar-right'>

									           <li><a href='/Login.php'>Login</a></li>

                                                                                   <li><a href='/Register.php'>Register</a></li>

										";

									

									}

									?>

    </ul>

  </div>

</nav>

<?

