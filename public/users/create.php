<?php
require_once __DIR__ . '/../header.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $passwordRepeat = $_POST['password_repeat'] ?? '';
    $role = $_POST['role'] ?? '';

    // -----------------------------
    // VALIDATION
    // -----------------------------
    if ($username === '' || $email === '' || $password === '' || $passwordRepeat === '' || $role === '') {
        $error = "Please fill out every field!";
    } elseif (mb_strlen($username) < 3) {
        $error = "Username must be at least 3 characters!";
    } elseif ($password !== $passwordRepeat) {
        $error = "Passwords do not match!";
    }

    // check if username/email already exists
    if (!$error) {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :u OR email = :e");
        $stmt->execute(['u' => $username, 'e' => $email]);
        if ($stmt->fetch()) {
            $error = "Username or email is already used!";
        }
    }

    // -----------------------------
    // IMAGE UPLOAD / DEFAULT
    // -----------------------------
    if (!$error) {
        $imageName = $_FILES['image']['name'] ?? '';
        $tmp       = $_FILES['image']['tmp_name'] ?? '';

        $targetDir = realpath(__DIR__ . '/../../uploads/') . '/';

        if ($tmp && is_uploaded_file($tmp)) {
            // user uploaded a file
            if (!getimagesize($tmp)) {
                $error = "This file is not an image!";
            } else {
                $newFile = uniqid() . "_" . basename($imageName);
                $targetFile = $targetDir . $newFile;
                $relativePath = '/uploads/' . $newFile;

                if (!move_uploaded_file($tmp, $targetFile)) {
                    $error = "Cannot upload file!";
                }
            }
        } else {
            // user did not upload → use default image based on role
            $relativePath = '/uploads/' . strtolower($role) . '.png';
        }
    }

    // -----------------------------
    // INSERT USER
    // -----------------------------
    if (!$error) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("
            INSERT INTO users (username, email, role, profile_image, password_hash)
            VALUES (:u, :e, :r, :img, :pw)
        ");

        $stmt->execute([
            'u'   => $username,
            'e'   => $email,
            'r'   => $role,
            'img' => $relativePath,
            'pw'  => $hash
        ]);

        $_SESSION['user'] = $username;
        header("Location: " . $path . "index.php");
        exit;
    }
}
?>

<main class="container card">
    <h2>Create a new user</h2>

    <?php if ($error): ?>
        <div style="color:red; margin-bottom: 1rem;"><?= $error ?></div>
    <?php endif; ?>

    <form action="<?= $_SERVER['SCRIPT_NAME']; ?>" method="post" enctype="multipart/form-data">

        <label> Username :
            <input type="text" name="username" required>
        </label>

        <label> E-Mail :
            <input type="email" name="email" required>
        </label>

        <label> Password :
            <input type="password" name="password" required>
        </label>

        <label> Password Repeat :
            <input type="password" name="password_repeat" required>
        </label>

        <label> Role :
            <select name="role">
                <option value="admin">Admin</option>
                <option value="moderator">Moderator</option>
                <option value="user">User</option>
            </select>
        </label>

        <label>Select image:
            <input type="file" name="image">
            <small>(Optional, default image will be used if not selected)</small>
        </label>

        <button style="margin: 1rem 0;" type="submit">Submit</button>
    </form>
</main>