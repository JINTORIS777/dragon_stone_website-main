<?php
require_once __DIR__.'/server/config.php';
session_start();
$conn = db_connect();
$errors = [];
if($_SERVER['REQUEST_METHOD']==='POST'){
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    if(!$email) $errors[]='Email required';
    if(!$password) $errors[]='Password required';
    if(empty($errors)){
        $stmt = $conn->prepare('SELECT id,password FROM users WHERE email=? LIMIT 1');
        $stmt->bind_param('s',$email);
        $stmt->execute();
        $res = $stmt->get_result();
        if($user = $res->fetch_assoc()){
            if(password_verify($password,$user['password'])){
                $_SESSION['user_id']=$user['id'];
                $_SESSION['email']=$email;
                header('Location: account.php'); exit;
            } else $errors[]='Invalid credentials';
        } else $errors[]='Invalid credentials';
        $stmt->close();
    }
}
$registered = isset($_GET['registered']);
?>
<!doctype html><html><head><meta charset="utf-8"><title>Login</title></head><body>
<h2>Login</h2>
<?php if($registered): ?><p style="color:green">Registration successful — please login.</p><?php endif; ?>
<?php if($errors): ?><ul style="color:red;"><?php foreach($errors as $e): ?><li><?=htmlspecialchars($e)?></li><?php endforeach; ?></ul><?php endif; ?>
<form method="post" action="login.php">
<label>Email<br><input name="email" value="<?=htmlspecialchars($email ?? '')?>"></label><br>
<label>Password<br><input type="password" name="password"></label><br>
<button type="submit">Login</button>
</form>
<p>No account? <a href="register.php">Register</a></p>
</body></html>
