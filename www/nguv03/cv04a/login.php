<?php 
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
    <form>
        <input name="email" type="email">
        <input name="password" type="password">
        <button>Log in</button>
    </form>
</main>
<?php include __DIR__ . '/includes/foot.php'; ?>
    
