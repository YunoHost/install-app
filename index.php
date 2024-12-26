<?php
// Retrieve the app from the URL using GET
$app = htmlentities($_GET['app']);

// Retrieve the correct locale JSON
$user_locale = substr(Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']), 0, 2);
// Check if the user locale exists, otherwise switch to "en"
if (!file_exists("locales/".$user_locale.".json")) { $user_locale = 'en'; }
$locale=json_decode(file_get_contents("locales/".$user_locale.".json"), true);

// Parse the apps list
$apps_list_json=file_get_contents("https://app.yunohost.org/default/v3/apps.json");
$apps_list=json_decode($apps_list_json, true)["apps"];

// Check if the app is the apps list
if(array_key_exists($app, $apps_list)) {
    // The app is in the apps list
    $app_status = $apps_list[$app]['state'];             // Saves the app state
    $app_name = $apps_list[$app]['manifest']['name'];    // Saves the app name
    $app_git = $apps_list[$app]['git']['url'];           // Saves the git URL
    if (array_key_exists("level", $apps_list[$app])) {
        $app_level = $apps_list[$app]['level'];
    }
    else {
        $app_level = 0;
        $app_status = null;
    }
}
else {
    // The app is not in the apps list
    $app_status = null;
    $app_name = "";
}

// If the user submitted his or her server and the app is in apps ist, redirects to the server
if(isset($_POST['server']) AND !empty($_POST['server']) AND $app_status == 'working') {
    $server = rtrim(preg_replace('#^https?://#', '', $_POST['server']),"/");
    $url = 'https://'.$server.'/yunohost/admin/#/apps/install/'.$app;
    header('Location: '.$url);
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo str_replace("{app_name}", $app_name, $locale['title']); ?></title>

  <!-- Responsive -->
  <meta name="format-detection" content="telephone=no" />
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1" />

  <!-- Do not index SSOWat pages -->
  <meta name="robots" content="noindex, nofollow">

  <!-- Stylesheets -->
    <link rel="stylesheet" href="assets/css/ynh-style.css">

  <!-- Icons -->
  <link rel="shortcut icon" href="assets/icons/favicon.ico">
  <link rel="apple-touch-icon" sizes="57x57" href="assets/icons/apple-touch-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="114x114" href="assets/icons/apple-touch-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="72x72" href="assets/icons/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="144x144" href="assets/icons/apple-touch-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="60x60" href="assets/icons/apple-touch-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="120x120" href="assets/icons/apple-touch-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/icons/apple-touch-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="152x152" href="assets/icons/apple-touch-icon-152x152.png">
  <link rel="icon" type="image/png" href="assets/icons/favicon-196x196.png" sizes="196x196">
  <link rel="icon" type="image/png" href="assets/icons/favicon-160x160.png" sizes="160x160">
  <link rel="icon" type="image/png" href="assets/icons/favicon-96x96.png" sizes="96x96">
  <link rel="icon" type="image/png" href="assets/icons/favicon-16x16.png" sizes="16x16">
  <link rel="icon" type="image/png" href="assets/icons/favicon-32x32.png" sizes="32x32">
  <meta name="msapplication-TileColor" content="#41444f">
  <meta name="msapplication-TileImage" content="/mstile-144x144.png">
</head>
<body>
    <h1 id="logo" class="logo">
      <img src="assets/img/logo-ynh-white.svg"/><span class="element-invisible">Yunohost</span>
    </h1>

<div class="overlay">

    <div class="ynh-wrapper login">

<?php
// The app is in apps list, display an install form
if($app_status == 'working') {
        if($app_level <= 4) {
?>
        <div class="wrapper messages warning">
            <p><?php echo $locale['app_state_warning']; ?></p>
        </div>
<?php
       }
?>
        <form class="login-form" name="input" action="" method="post">
              <div class="form-group">
                <label class="icon icon-connexion" for="server"><span class="element-invisible"><?php echo $locale['server_link']; ?></span></label>
                <input id="server" type="text" name="server" placeholder="<?php echo $locale['server_link']; ?>" class="form-text" autofocus required>
              </div>
              <input type="submit" value="<?php echo str_replace("{app_name}", $app_name, $locale['install_button']); ?>" class="btn classic-btn large-btn">
        </form>
<?php
}
// The app is not in the apps list
else {
?>
    <div class="wrapper messages danger">
        <p><?php echo $locale['app_notfound']; ?></p>
    </div>
<?php
}
?>

    <div class="wrapper messages success">
        <h3><?php echo $locale['noserver']; ?></h3>
        <p><?php echo $locale['yunohost']; ?></p>
        <p><a href="https://yunohost.org/#/" title="<?php echo $locale['discover']; ?>" class="btn link-btn"><?php echo $locale['discover']; ?></a></p>
    </div>

</div>

  <!-- Scripts -->
  <script src="assets/js/global.js"></script>
</body>
</html>
