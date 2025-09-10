<?php
final class Usuario {
    public static function porUsuario(string $usuario): ?array {
        $db = Conexion::connect();
        $st = $db->prepare('SELECT * FROM usuarios WHERE usuario = ? AND estado = "Activo" LIMIT 1');
        $st->bind_param('s', $usuario);
        $st->execute();
        $res = $st->get_result();
        $row = $res ? $res->fetch_assoc() : null;
        $st->close();
        return $row ?: null;
    }

    public static function verificarPassword(string $plain, string $hash): bool {
        $isMd5 = (bool)preg_match('/^[a-f0-9]{32}$/i', $hash);
        if ($isMd5) return hash_equals($hash, md5($plain));
        return password_verify($plain, $hash);
    }
}
