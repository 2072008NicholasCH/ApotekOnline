<?php

/**
 * @author Nicholas CH 2072008
 * @author Juan Sterling 2072009
 * @author Kevin Laurence 2072030
 */

?>

<form method="post">
    <div class="form-group">
        <label for="employeeId">Employee ID</label>
        <input type="text" class="form-control" id="employeeId" name="txtId" required autofocus placeholder="example@email.com">
    </div>
    <div class="form-group">
        <label for="passwordId">Password</label>
        <input type="password" class="form-control" id="passwordId" name="txtPassword" required>
    </div>
    <button type="submit" class="btn btn-primary" name="btnLogin">Submit</button>
</form>