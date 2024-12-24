<?php
// Definición de constantes para personalizar la aplicación

// Colores principales
define('COLOR_PRIMARIO', '#007bff');   // Azul para elementos importantes (botones, encabezados)
define('COLOR_SECUNDARIO', '#6c757d'); // Gris oscuro para botones secundarios
define('COLOR_EXITO', '#28a745');      // Verde (para exito)
define('COLOR_ADVERTENCIA', '#ffc107'); // Amarillo (para advertencias)
define('COLOR_ERROR', '#dc3545');      // Rojo (para errores)
define('COLOR_FONDO', '#f8f9fa');      // Fondo gris claro
define('COLOR_TEXTO', '#212529');      // Texto oscuro
define('COLOR_TABLA_FONDO', '#ffffff'); // Fondo blanco para tablas

// Tipografía
define('FUENTE_TITULOS', 'Arial, Helvetica, sans-serif');
define('FUENTE_TEXTO', 'Roboto, sans-serif');

// Tamaños de fuentes personalizados
define('TAMANIO_TITULO', '2rem'); // Tamaño para títulos principales
define('TAMANIO_SUBTITULO', '1.5rem'); // Tamaño para subtítulos
define('TAMANIO_TEXTO', '1rem'); // Tamaño para textos comunes

// Espaciado
define('ESPACIADO_PAGINA', '1rem'); // Espaciado general de la página
define('ESPACIADO_CAMPOS', '1.25rem'); // Espaciado en formularios y campos

// Bordes y sombras
define('BORDE_ESTILO', '1px solid #dee2e6'); // Bordes de inputs y botones
define('BORDE_RADIUS', '0.375rem'); // Borde redondeado (usado por defecto en Bootstrap)

// Estilo de botones personalizados
define('BOTON_FONDO', COLOR_PRIMARIO);
define('BOTON_COLOR', '#fff'); // Color del texto en los botones
define('BOTON_FONDO_SECUNDARIO', COLOR_SECUNDARIO);
define('BOTON_COLOR_SECUNDARIO', '#fff');
define('BOTON_FONDO_EXITO', COLOR_EXITO); // Fondo verde para éxito
define('BOTON_COLOR_EXITO', '#fff'); // Color blanco para el texto del botón de éxito

// Sombra para cuadros (usado en contenedores y tarjetas)
define('SOMBRA_CUADRO', '0 0.125rem 0.25rem rgba(0, 0, 0, 0.075)');

// Estilo de tablas
define('TABLE', 'table table-striped');
define('TABLA_BORDE', '1px solid #ced4da'); // Borde de la tabla
define('TABLA_COLOR_FONDO', '#ffffff'); // Fondo blanco para las filas
define('TABLA_COLOR_FILA_ALTERNADA', '#f8f9fa'); // Fondo alternativo para las filas
define('TABLA_TEXTO_FILA', '#495057'); // Color de texto de las filas

// Campos de búsqueda y actualización
define('CAMPO_BUSQUEDA_BORDE', '1px solid #ced4da'); // Borde de los campos de búsqueda
define('CAMPO_BUSQUEDA_FONDO', '#ffffff'); // Fondo blanco para los campos de búsqueda
define('CAMPO_BUSQUEDA_COLOR', '#495057'); // Color del texto del campo de búsqueda
define('CAMPO_BUSQUEDA_PADDING', '0.75rem'); // Padding para los campos de búsqueda

// Ancho máximo para contener elementos
define('ANCHO_MAXIMO', '1140px'); // Ancho máximo de la página

// Opciones de alineación para texto y botones
define('ALINEACION_CENTRO', 'text-center'); // Alineación centrada
define('ALINEACION_DERECHA', 'text-end');  // Alineación a la derecha

// Espaciado para clases de Bootstrap
define('MARGEN_VERTICAL', 'my-4'); // Margen vertical (my) para separar secciones
define('MARGEN_HORIZONTAL', 'mx-4'); // Margen horizontal (mx) para ajustar el contenido
define('PADDING_COMUN', 'p-3'); // Padding común para tarjetas y cuadros

?>
