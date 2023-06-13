if ($_SERVER['REQUEST_METHOD'] == 'POST') {

$id    = $_POST['userid'];
$user  = $_POST['name'];
$email = $_POST['email'];
$name  = $_POST['fullname'];

// Password Trick

$pass = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);

// The Inputs Errors

$formError = array();

if (strlen($user) < 4) {

    $formError[] = 'User Must Be More Than<strong> 2 Characters</strong>';
}
if (strlen($user) > 20) {

    $formError[] = 'User Must Be less Than<strong> 20 Characters</strong>';
}
if (empty($user)) {

    $formError[] = 'Username Can\'t Be<strong> Empty</strong>';

}
if (empty($email)) {

    $formError[] = 'Email Can\'t Be<strong> Empty</strong>';
}
if (empty($name)) {

    $formError[] = 'Full Name Can\'t Be<strong> Empty</strong>';
}
foreach ($formError as $error) {

    echo '<div class="alert alert-danger">' . $error . '</div>';

}

// check if is inputs empty or not if empty no update or not empty update
if (empty($formError)) {

    // Update The DataBase With This Info
    $stmt2 = $con->prepare("SELECT * FROM users WHERE Username = ? AND UserID != ?");

    $stmt2->execute(array($user, $id));

    $count = $stmt2->rowCount();

    if ($count == 1) {
        
        $theMsg = '<div class="error-msg">This User Is Exist</div>';
        redirectHome($theMsg, 'back');
    
    } else {

        $stmt = $con->prepare("UPDATE users SET Username = ?, Email = ?, FullName = ?, Password = ? WHERE UserID = ?");

        $stmt->execute(array($user, $email, $name, $pass, $id));

        // echo Success Message

        $theMsg = '<div class="alert alert-success">' . $stmt->rowCount() . ' Data Updated</div>';

        redirectHome($theMsg, 'back');
    }
}

} else {

$theMsg = '<div class="alert alert-danger">Error: You Can\'t Open This Page Directly</div>';

redirectHome($theMsg, 'back');
}
echo "</div>";