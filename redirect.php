<?php
require_once __DIR__ . '/connection.php';
require_once __DIR__ . '/User.php';

if(isset($_GET['code'])){ 
    $token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']); 
    $_SESSION['token'] = $gClient->getAccessToken(); 
    header('Location: ' . filter_var(GOOGLE_REDIRECT_URL, FILTER_SANITIZE_URL)); 
  } 
  
  if(isset($_SESSION['token'])){ 
    $gClient->setAccessToken($_SESSION['token']); 
  } 

if($gClient->getAccessToken()){ 
    // Get user profile data from google 
    $gpUserProfile = $google_oauthV2->userinfo->get(); 

    // Initialize User class 
    $user = new User(); 
     
    // Getting user profile info 
    $gpUserData = array(); 
    $gpUserData['oauth_id']  = !empty($gpUserProfile['id'])?$gpUserProfile['id']:''; 
    $gpUserData['first_name'] = !empty($gpUserProfile['given_name'])?$gpUserProfile['given_name']:''; 
    $gpUserData['last_name']  = !empty($gpUserProfile['family_name'])?$gpUserProfile['family_name']:''; 
    $gpUserData['email']       = !empty($gpUserProfile['email'])?$gpUserProfile['email']:''; 
    // $gpUserData['gender']       = !empty($gpUserProfile['gender'])?$gpUserProfile['gender']:''; 
    // $gpUserData['locale']       = !empty($gpUserProfile['locale'])?$gpUserProfile['locale']:''; 
    // $gpUserData['picture']       = !empty($gpUserProfile['picture'])?$gpUserProfile['picture']:''; 
     
    // Insert or update user data to the database 
    // $gpUserData['oauth_provider'] = 'google'; 
    $userData = $user->checkUser($gpUserData); 
 
    // Storing user data in the session 
    $_SESSION['userData'] = $userData; 
     
}else{
    // Si no hay un token de acceso, redirecciona a la página de inicio de sesión
    header('Location: login.php');
}
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900">
    <!-- component -->
    <div class="flex items-center h-screen w-full justify-center">

        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <div class="bg-gray-800 shadow-xl rounded-lg py-3">
                <div class="photo-wrapper p-2">
                    <img class="w-24 h-24 rounded-full mx-auto" src="https://www.gravatar.com/avatar/bfcb1d6a22d7098499771d3bcec5a8c4?d=identicon&f=y&s=128" alt="Profile imgae">
                </div>
                <div class="p-2">
                    <h3 class="text-center text-xl text-gray-300 font-medium leading-8"><?php echo $gpUserData['first_name'] . ' ' .  $gpUserData['last_name']?></h3>
                    <div class="text-center text-gray-400 text-xs font-semibold">
                        <p class="mt-2">Usuario</p>
                    </div>
                    <table class="text-xs my-3 mx-auto">
                        <tbody>
                            <tr>
                                <td class="px-2 py-2 text-gray-200 font-bold">ID</td>
                                <td class="px-2 py-2 text-gray-300"><?php echo $gpUserData['oauth_id'] ?></td>
                            </tr>
                            <tr>
                                <td class="px-2 py-2 text-gray-300 font-bold">Email</td>
                                <td class="px-2 py-2 text-gray-200"><?php echo $gpUserData['email'] ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="text-center my-3">
                        <a class="text-xs text-indigo-500 hover:underline hover:text-indigo-600 font-medium" href="logout.php">Logout</a>
                    </div>

                </div>
            </div>
        </div>

    </div>
</body>

</html>