<?php

require __DIR__ . '/utils/utils.php';

$invalidInputs = [];

$isSubmitted = !empty($_POST);
$message = "";

if ($isSubmitted) {
    $name = htmlspecialchars(trim($_POST['name']));
    $password = htmlspecialchars(trim($_POST['password']));

    if (empty($name)) {
        $invalidInputs["name"] = '*Vyplňte jméno';
    }

    if (empty($password)) {
        $invalidInputs["password"] = '*Vyplňte heslo';
    }

    if (empty($invalidInputs)) {
        $loginUser = authenticate($name, $password);
        if (!$loginUser['success']) {
            $invalidInputs["authentication"] = $loginUser['msg'];
        }
    }

    if (empty($invalidInputs)) {
        session_start();
        if (!isset($_SESSION['logged_user'])) {
            $_SESSION['logged_user'] = $name;
        }
        header('Location: index');
        $name = "";
        $password = "";
        exit();
    }
}
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/facebook/config.php';
$fb = new \Facebook\Facebook(CONFIG_FACEBOOK);
$helper = $fb->getRedirectLoginHelper();
$loginUrl = $helper->getLoginUrl(CONFIG_PROTOCOL . CONFIG_DOMAIN . CONFIG_PATH . '/fb-login-callback.php');

?>

<?php require __DIR__ . '/includes/head.php'; ?>
<?php require __DIR__ . '/includes/navbar.php'; ?>
    <main class="container-fluid" id="mainLogin">
        <div class="row justify-content-md-center my-bg text-center formHeight">
            <div class="col-md-4">
                <div class="card formCard">
                    <h1>
                        Přihlášení
                    </h1>
                    <form class="form-signup" method="POST" autocomplete="off">
                        <div class="form-group">
                            <label>Jméno <?php echo isset($invalidInputs["name"]) ? "<small class='errorColor'>" . $invalidInputs["name"] . "</small>" : "" ?></label>
                            <input autocomplete="off"
                                   class="form-control <?php echo getInputValidClass('name', $invalidInputs); ?>""
                            name="name" value="<?php echo isset($name) ? $name : '' ?>">
                        </div>
                        <div class="form-group">
                            <label>Heslo <?php echo isset($invalidInputs["password"]) ? "<small class='errorColor'>" . $invalidInputs["password"] . "</small>" : "" ?></label>
                            <input autocomplete="off"
                                   class="form-control <?php echo getInputValidClass('password', $invalidInputs); ?>"
                                   name="password"
                                   type="password"
                                   value="<?php echo isset($password) ? $password : '' ?>">
                        </div>
                        <?php echo isset($invalidInputs["authentication"]) ? "<small class='errorColor'>" . $invalidInputs["authentication"] . "</small></br>" : "" ?>
                        <span><a href="registration">Nemáte účet? Zaregistrujte se zde!</a></span>
                        <div class="row mt-10">
                            <button class="btn btn-primary" type="submit">Přihlásit se</button>
                        </div>
                        <div class="row mt-4">
                            <hr>
                        </div>
                        <div class="row">
                            <a href="<?php echo htmlspecialchars($loginUrl); ?>" class="fb btn">
                                Přihlásit se přes Facebook
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

<?php require __DIR__ . '/includes/foot.php'; ?>