<?php
include 'main.php';
// Default input account values
$account = array(
    'username' => '',
    'password' => '',
    'email' => '',
    'activation_code' => '',
    'rememberme' => '',
    'role' => 'Member'
);
$roles = array('Member', 'Admin');
if (isset($_GET['id'])) {
    // Get the account from the database
    $stmt = $pdo->prepare('SELECT * FROM accounts WHERE id = ?');
    $stmt->execute([ $_GET['id'] ]);
    $account = $stmt->fetch(PDO::FETCH_ASSOC);
    // ID param exists, edit an existing account
    $page = 'Edit';
    if (isset($_POST['submit'])) {
        // Update the account
        $stmt = $pdo->prepare('UPDATE accounts SET username = ?, password = ?, email = ?, activation_code = ?, rememberme = ?, role = ? WHERE id = ?');
        $password = $account['password'] != $_POST['password'] ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $account['password'];
        $stmt->execute([ $_POST['username'], $password, $_POST['email'], $_POST['activation_code'], $_POST['rememberme'], $_POST['role'], $_GET['id'] ]);
        header('Location: index.php');
        exit;
    }
    if (isset($_POST['delete'])) {
        // Delete the account
        $stmt = $pdo->prepare('DELETE FROM accounts WHERE id = ?');
        $stmt->execute([ $_GET['id'] ]);
        header('Location: index.php');
        exit;
    }
} else {
    // Create a new account
    $page = 'Create';
    if (isset($_POST['submit'])) {
        $stmt = $pdo->prepare('INSERT IGNORE INTO accounts (username,password,email,activation_code,rememberme,role) VALUES (?,?,?,?,?,?)');
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt->execute([ $_POST['username'], $password, $_POST['email'], $_POST['activation_code'], $_POST['rememberme'], $_POST['role'] ]);
        header('Location: index.php');
        exit;
    }
}
?>

<?=template_admin_header($page . ' Account')?>

<h2><?=$page?> Account</h2>

<div class="content-block">
    <form action="" method="post" class="form responsive-width-100">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Username" value="<?=$account['username']?>" required>
        <label for="password">Password</label>
        <input type="text" id="password" name="password" placeholder="Password" value="<?=$account['password']?>" required>
        <label for="email">Email</label>
        <input type="text" id="email" name="email" placeholder="Email" value="<?=$account['email']?>" required>
        <label for="activation_code">Activation Code</label>
        <input type="text" id="activation_code" name="activation_code" placeholder="Activation Code" value="<?=$account['activation_code']?>">
        <label for="rememberme">Remember Me Code</label>
        <input type="text" id="rememberme" name="rememberme" placeholder="Remember Me Code" value="<?=$account['rememberme']?>">
        <label for="role">Role</label>
        <select id="role" name="role" style="margin-bottom: 30px;">
            <?php foreach ($roles as $role): ?>
            <option value="<?=$role?>"<?=$role==$account['role']?' selected':''?>><?=$role?></option>
            <?php endforeach; ?>
        </select>
        <div class="submit-btns">
            <input type="submit" name="submit" value="Submit">
            <?php if ($page == 'Edit'): ?>
            <input type="submit" name="delete" value="Delete" class="delete">
            <?php endif; ?>
        </div>
    </form>
</div>

<?=template_admin_footer()?>
