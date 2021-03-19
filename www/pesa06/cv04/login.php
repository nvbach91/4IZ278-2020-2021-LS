<?php
function validateUserCredentials($data, &$errors)
{
    $databaseFileName = __DIR__ . '/database/users.db';
    $users = file($databaseFileName);
    $counter = 0;
    foreach ($users as $user) {
        if (!$user) {
            continue;
        }
        $fields = explode(';', $user);
        if ($fields[1] === $data['email']) {
            if (rtrim($fields[2]) === $data['password']) {
                return $counter;
            }
            $errors[] = 'Incorrect password!';
            return null;
        }
        $counter++;
    }

    $errors[] = 'User and password combination not found!';
    return null;
}

$email = isset($_GET['email']) ? $_GET['email'] : null;
$errors = [];
if (!empty($_POST)) {
    $data = $_POST;
    if (empty($data['email']) || empty($data['password'])) {
        $errors[] = 'Neither email nor password can be blank!';
    } else {
        $userRow = validateUserCredentials($data, $errors);
        if ($userRow !== null) {
            header("Location: index.php?userRow=$userRow");
        }
    }
}
// nacist data z POST objektu
// nacist data z db souboru
// proiterovat zaznamy z db v poli
// pritom porovnat informace (email + heslo) z formulare s jednolivymi zaznamy v db
// vratit vysledek
// podle vysledku zobrazit info uzivateli na strance
// pokud uspech login -> presmerovat na homepage
// pokud neuspech -> zobrazit proc na strance
?>
<?php include __DIR__ . '/includes/head.php'; ?>
<?php include __DIR__ . '/includes/navigation.php'; ?>
    <main>
        <h1>Login</h1>
        <?php foreach ($errors as $error): ?>
            <p><?php echo $error; ?></p>
        <?php endforeach; ?>
        <?php if ($email !== null) {
            echo "<p>Thank you for your registration, $email!</p>";
        } ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input name="email" type="email" value="<?php echo $email === null ? '' : $email; ?>">
            <input name="password" type="password">
            <button>Log in</button>
        </form>
    </main>
<?php include __DIR__ . '/includes/foot.php'; ?>