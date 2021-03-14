<?php include __DIR__ . '/includes/header.php' ?>
<main>
    <h1>Welcome</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
        </tr>
        <?php
        $db = __DIR__ . '/database/users.db';
        $records = file($db);
        foreach ($records as $r) {
            $fields = explode(';', $r);
            echo "<tr>";
            foreach ($fields as $f) {
                echo "<td>$f</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>
<a class="btn btn-primary signup" href="registration.php">I want to be in the list</a>
</main>
<?php include __DIR__ . '/includes/footer.php' ?>
