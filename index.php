<?php
// PHP headers
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');

// Session
session_start();

// Debug mode
ini_set('display_errors', 0);
error_reporting(0);

require_once 'classes/Model.php';
require_once 'classes/Controller.php';

try {
    $controller = new Controller();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller->onSubmit();
    }
}
catch (Exception $ex) {
    $fatalError = $ex->getMessage();
}
?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Event Registration Form</title>
</head>
<body class="">
<?php if ($fatalError) { ?>
    <div class="alert alert-danger" style="color:red;">
        <?php echo $fatalError; ?>
    </div>
<?php } ?>
<?php if (!empty($_GET['code'])) { ?>
    <h3>Voucher</h3>
    <p>Name: <?php echo $_GET['name'] ?></p>
    <p>Voucher code: <?php echo $_GET['code'] ?></p>
<?php } else { ?>
    <form id="event-form" accept-charset="utf-8" method="POST" role="form">
        <div>
            <label for="fullName">Full name</label>
            <input type="text" name="name" id="fullName" placeholder="John Doe" />
        </div>
        <div>
            <label for="telephone">Telephone number</label>
            <input type="text" name="telephone" id="telephone" placeholder="07319333943" />
        </div>
        <div>
            <label for="workshop">Workshops</label>
            <select name="workshop" id="workshop">
                <option value="london">London Workshop</option>
                <option value="paris">Paris Workshop</option>
                <option value="milan">Milan Workshop</option>
                <option value="madrid">Madrid Workshop</option>
            </select>
        </div>
        <div>
            <label for="email">Email address</label>
            <input type="email" name="email" id="email" placeholder="" />
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" />
        </div>

        <div>
            <button
                type="submit"
            >Submit</button>
        </div>
    </form>
<?php } ?>
</body>
</html>

