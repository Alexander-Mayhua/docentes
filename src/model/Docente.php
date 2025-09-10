<?php
final class Docente {
    public static function todos(): array {
        $db = Conexion::connect();
        $res = $db->query('SELECT * FROM docentes ORDER BY apellidos, nombres');
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }

    public static function uno(int $id): ?array {
        $db = Conexion::connect();
        $st = $db->prepare('SELECT * FROM docentes WHERE id_docente = ?');
        $st->bind_param('i', $id);
        $st->execute();
        $res = $st->get_result();
        $row = $res ? $res->fetch_assoc() : null;
        $st->close();
        return $row ?: null;
    }

    public static function crear(array $d): int {
        $db = Conexion::connect();
        $sql = 'INSERT INTO docentes (dni, nombres, apellidos, correo, telefono, especialidad, grado_academico, estado) VALUES (?,?,?,?,?,?,?,?)';
        $st = $db->prepare($sql);
        $st->bind_param(
            'ssssssss',
            $d['dni'], $d['nombres'], $d['apellidos'], $d['correo'], $d['telefono'], $d['especialidad'], $d['grado_academico'], $d['estado']
        );
        $st->execute();
        $id = (int)$db->insert_id;
        $st->close();
        return $id;
    }

    public static function actualizar(int $id, array $d): void {
        $db = Conexion::connect();
        $sql = 'UPDATE docentes SET dni=?, nombres=?, apellidos=?, correo=?, telefono=?, especialidad=?, grado_academico=?, estado=? WHERE id_docente=?';
        $st = $db->prepare($sql);
        $st->bind_param(
            'ssssssssi',
            $d['dni'], $d['nombres'], $d['apellidos'], $d['correo'], $d['telefono'], $d['especialidad'], $d['grado_academico'], $d['estado'], $id
        );
        $st->execute();
        $st->close();
    }

    public static function eliminar(int $id): void {
        $db = Conexion::connect();
        $st = $db->prepare('DELETE FROM docentes WHERE id_docente=?');
        $st->bind_param('i', $id);
        $st->execute();
        $st->close();
    }
}
