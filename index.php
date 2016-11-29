<?php
$app = htmlentities($_GET['app']);
if(isset($_POST['server']) AND !empty($_POST['server'])) {
	$server = preg_replace('#^https?://#', '', $_POST['server']);
	$url = 'https://'.$server.'/yunohost/admin/#/apps/install/'.$app;
	header('Location: '.$url);
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="format-detection" content="telephone=no" />
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1" />
	<meta name="robots" content="noindex, nofollow">
	<title>Install with YunoHost</title>
	<style>
	* {
	  -webkit-box-sizing: border-box;
		 -moz-box-sizing: border-box;
			  box-sizing: border-box;
	}

	html {
	  font-family: sans-serif; /* 1 */
	  -ms-text-size-adjust: 100%; /* 2 */
	  -webkit-text-size-adjust: 100%; /* 2 */
	}

	body {
	  background: #41444f;
	  font-family: arial;
	  overflow-y: scroll;
	  font-size: 1em;
	  line-height:1.5;
	  margin: 0;
	  padding: 0;
	}
	
	img {
	  max-width: 100%;
	  height :auto;
	}
	
	.logo {
	  text-align: center;
	  margin-bottom: 0;
	  opacity: 0.7;
	}
	
	.logo img {
	  margin-top: 4%;
	  width: 4em;
	}
	
	.wrapper {
	  width: 90%;
	  margin: 2% 5%;
	  position: relative;
	  z-index: 1;
	}

	.form {
	  max-width: 21em;
	  margin: 0 auto;
	}

	input {
		border:none;
		box-shadow:none;
		position: relative;
		margin-bottom: 1em;
	}
  
	input[type="submit"] {
	  width: 100%;
	  padding: 0.8em 1.5em;
	  font-size: 1.1em;
	  background: #999;
	  display: inline-block;
	  padding: 0.5em 1em;
	  line-height: normal;
	  text-decoration: none;
	  color: #FFF;
	  background: #2980b9;
	  cursor: pointer;
			  transition: all 0.1s ease;
	  -webkit-transition: all 0.1s ease;
	  border:0;
	  cursor:pointer;
	}
	input[type="submit"]:hover {background: #3498db;}
	
	input[type="text"] {
		background: #fff;
		color: #41444f;
		width: 100%;
		padding: 0.8em 0.8em 0.8em 3em;
	}
	
	.messages {
	  color: #FFF;
	  margin-bottom: 1em;
	  text-align: center;
	  max-width: 21em;
	  margin: 2% auto 1em auto;
	  padding: 1.5em;
	}
	.messages.danger { background: #c0392b; }
	.messages.warning { background: #e67e22; }
	.messages.success { background: #27ae60; }
	.messages.info { background: #2980b9; }
	</style>
</head>
<body>
	<h1 id="logo" class="logo">
		<img src="logo-ynh-white.svg"/>
	</h1>
	<div class="overlay">
		<!--<div class="wrapper messages info">Please enter the address of your YunoHost server</div>-->
		<div class="wrapper">
			<form class="form" name="input" action="" method="post">
				<input id="server" type="text" name="server" placeholder="Link to your YunoHost server" autofocus required>
				<input type="submit" value="Install <?php echo $app; ?>">
			</form>
		</div>
	</div>
</body>
</html>