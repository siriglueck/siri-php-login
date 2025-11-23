<?php
    declare(strict_types=1);

    function getAllUsers(PDO $pdo):array {
        $stmt = $pdo->query("SELECT * FROM users ORDER BY id ASC");
        return $pdo = $stmt->fetchAll();
    }

    function deleteNote(PDO $pdo, int $id): void {
        $stmt = $pdo->prepare('DELETE FROM users WHERE id=:id');
        $stmt->execute([':id'=>$id]);
    }

    

