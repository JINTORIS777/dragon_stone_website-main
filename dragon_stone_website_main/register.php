<?php
require_once __DIR__.'/server/config.php';
$conn = db_connect();
$errors = [];
if($_SERVER['REQUEST_METHOD']==='POST'){
    $name = trim($_POST['name'] ?? $_POST['user_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? $_POST['password2'] ?? '';
    if(!$name) $errors[]='Name required';
    if(!$email || !filter_var($email,FILTER_VALIDATE_EMAIL)) $errors[]='Valid email required';
    if(strlen($password)<6) $errors[]='Password >=6 chars';
    if($password !== $confirm) $errors[]='Passwords do not match';
    if(empty($errors)){
        $stmt = $conn->prepare('SELECT id FROM users WHERE email=? LIMIT 1');
        $stmt->bind_param('s',$email);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows>0){ $errors[]='Email already registered'; }
        else{
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $ins = $conn->prepare('INSERT INTO users (user_name,email,password) VALUES (?,?,?)');
            $ins->bind_param('sss',$name,$email,$hash);
            if($ins->execute()){
                header('Location: login.php?registered=1'); exit;
            } else $errors[]='Registration failed';
        }
        $stmt->close();
    }
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Register</title></head><body>
<h2>Register</h2>
<?php if($errors): ?><ul style="color:red;"><?php foreach($errors as $e): ?><li><?=htmlspecialchars($e)?></li><?php endforeach; ?></ul><?php endif; ?>
<form method="post" action="register.php">
<label>Name<br><input name="name" value="<?=htmlspecialchars($name ?? '')?>"></label><br>
<label>Email<br><input name="email" value="<?=htmlspecialchars($email ?? '')?>"></label><br>
<label>Password<br><input type="password" name="password"></label><br>
<label>Confirm Password<br><input type="password" name="confirm_password"></label><br>
<button type="submit">Register</button>
</form>
<p>Have account? <a href="login.php">Login</a></p>
</body></html>
