<?php
//     require_once '../vendor/autoload.php';

//     use App\Page;
    
//     $page = new Page();

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $email = $_POST["email"];
//     $password = $_POST["password"];
//     if (1==1) {
//         header("Location: accueil.php");
//         exit();
//     } else {
//         $messageErreur = "Adresse email ou mot de passe incorrect.";
//     }
// }


// function verifierConnexion($email, $password) {
//     return ($email === "utilisateur@example.com" && $password === "motdepasse");
// }


require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
$msg = false;

if(isset($_POST['send'])){
    $user = $page->getUserByEmail([
        'email' => $_POST['email']
    ]);

    

    if (!$user){$msg = "email ou mot de passe incorrect !";} 
    else {
        if (!password_verify($_POST['password'],$user['password'])){
            $msg = "mauvais mot de passe ";
        }
        else{
            $page->$session->add('user',$user);
            header('Location: profile.php');
        }
    }
}
echo $page->render('login.html.twig',[
    'msg' => $msg
]);
