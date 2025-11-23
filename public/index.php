<?php

require_once __DIR__ . '/header.php';
require_once __DIR__ . '/../inc/functions.php';

$users = getAllUsers($pdo);


?>

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
              <td><img src="..<?= ($u->profile_image)?>" class="icon" onerror="this.onerror=null; this.src='../uploads/nopic.svg';" ></td>
              <td><?= $u->id?></td>
              <td><?= $u->username ?></td>
              <td><?= $u->role?></td>
              <td><?= $u->created_at?></td>
              <td><?= $u->updated_at?></td>
              <td><a href="edit.php?id=<?= (int)$u->id ?>" class="button">Edit</a></td>
              <td><a href="users/delete.php?id=<?= (int)$u->id ?>" class="button text-danger">Delete</a></td>
              
            </tr>
          <?php endforeach; ?>
        <tbody>

        </tbody>
      </table>
    </main>
</body>
</html>