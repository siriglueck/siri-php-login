<?php
declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once __DIR__ . '/header.php';

$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll();

?>
<body>
    <?php include_once 'nav.php' ?>
    <main class="container card">
         <table>
        <thead>
          <tr>
            <th>Img</th>
            <th>ID</th>
            <th>Username</th>
            <th>Role</th>
            <th>Created</th>
            <th>Updated</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
          <?php foreach ($users as $u): ?>
            <tr>
              <td><img src="..<?= ($u->profile_image)?>" class="icon" onerror="this.onerror=null; this.src='../uploads/user.png';" ></td>
              <td><?= $u->id?></td>
              <td><?= $u->username ?></td>
              <td><?= $u->role?></td>
              <td><?= $u->created_at?></td>
              <td><?= $u->updated_at?></td>
              <td><a href="edit.php?id=<?= (int)$u->id ?>" class="button">Bearbeiten</a></td>
              <td><a href="edit.php?id=<?= (int)$u->id ?>" class="button text-danger">Löschen</a></td>
                <!-- <form action="delete.php" style="display:inline;" method="post">
                  <input type="hidden" name="id" value="<?= (int)$u->id ?>">
                  <button type="submit" class="button text-danger">Löschen</button>
                </form> -->
              
            </tr>
          <?php endforeach; ?>
        <tbody>

        </tbody>
      </table>
    </main>
</body>
</html>