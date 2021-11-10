<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
RESTABLECE TU CONTRASEÑA EN EL SIGUENTE LINK :):
{{ env("APP_FRONT") .'/reset-password' . '?token=' . $passwordReset->token }}
</body>
</html>
