<?php
class SenhaValidacao
{
    public static function validarSenha(string $senha)
    {
        if (strlen($senha) < 8) {
            return "A senha precisa de no mínimo 8 caracteres";
        }
        if (!preg_match('/[A-Z]/', $senha)) {
            return "A senha precisa de no mínimo 1 letra maiúscula";
        }
        if (!preg_match('/[a-z]/', $senha)) {
            return "A senha precisa de no mínimo 1 letra minúscula";
        }
        if (!preg_match('/[0-9]/', $senha)) {
            return "A senha precisa de no mínimo 1 número";
        }
        return null;
    }
}
?>
