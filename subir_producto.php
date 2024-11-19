<?php
// Definir la carpeta de destino
$carpetaDestino = 'img/';

// Verificar si se ha enviado el archivo
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
    // Obtener la información del archivo
    $archivo = $_FILES['imagen'];
    $nombreArchivo = $archivo['name'];
    $rutaTemporal = $archivo['tmp_name'];
    $errorArchivo = $archivo['error'];
    $tamañoArchivo = $archivo['size'];

    // Verificar si el archivo es una imagen
    $tipoArchivo = mime_content_type($rutaTemporal);
    if (strpos($tipoArchivo, 'image') !== false) {
        // Generar un nombre único para evitar sobrescribir archivos
        $nombreUnico = uniqid() . '_' . $nombreArchivo;

        // Establecer la ruta completa donde se guardará el archivo
        $rutaFinal = $carpetaDestino . $nombreUnico;

        // Intentar mover el archivo a la carpeta de destino
        if (move_uploaded_file($rutaTemporal, $rutaFinal)) {
            echo "<div class='alert alert-success'>El producto se ha subido exitosamente.</div>";
        } else {
            echo "<div class='alert alert-danger'>Hubo un error al guardar el archivo.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Por favor, seleccione un archivo de imagen.</div>";
    }
} else {
    echo "<div class='alert alert-danger'>No se ha seleccionado ningún archivo o hubo un error en la subida.</div>";
}
?>
