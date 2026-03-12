# marcosdicaprio.dev

Un tema clásico, minimalista, accesible y optimizado para SEO con una estética técnica, diseñado especialmente para blogs personales y de desarrollo.

## Características Principales

- 🌗 **Modo Claro / Oscuro**: Soporte nativo para alternar entre temas claro y oscuro, con persistencia.
- ⚡ **Sin Gutenberg**: Utiliza el editor clásico (deshabilita Gutenberg) para una experiencia de escritura más limpia, rápida y centrada en el contenido.
- ⏱️ **Tiempo de Lectura**: Cálculo y visualización automática del tiempo estimado de lectura en las publicaciones.
- 📑 **Tabla de Contenidos (TOC)**: Generación automática e interactiva de índices para los artículos, mejorando la navegación y la experiencia de usuario.
- 🚫 **Comentarios Desactivados**: Sistema de comentarios desactivado por defecto a nivel global para mantener un diseño limpio (ideal para portfolios o blogs técnicos unidireccionales).
- 🔗 **Botones para Compartir**: Integración elegante de botones sociales (LinkedIn, X, Facebook, WhatsApp y Copiar Enlace) en la vista individual de las entradas.
- 🎨 **Tipografía Cuidadosa y Limpia**: Uso de la fuente *Lato* para una lectura cómoda y fluida en textos largos, y *JetBrains Mono* para bloques de código que refuerzan la identidad de un desarrollador.

## Estructura del Tema

La configuración y funcionalidades principales del tema se gestionan de manera modular desde el archivo principal `functions.php` hacia el directorio `/inc/`:

- `setup.php`: Inicialización del tema, menús y soporte básico de funcionalidades de WordPress.
- `enqueue.php`: Carga estructurada de estilos (`style.css`), scripts y fuentes de Google.
- `reading-time.php`: Lógica y marcado para mostrar el tiempo de lectura estimado.
- `toc.php`: Funcionalidades requeridas para listar dinámicamente el contenido del artículo.
- `disable-gutenberg.php`: Filtros para deshabilitar el editor de bloques de WordPress moderno.
- `disable-comments.php`: Filtros y limpieza para erradicar cualquier rastro del sistema de comentarios.

## Instalación

1. Sube la carpeta o clona el repositorio del tema dentro del directorio `wp-content/themes/` de tu instalación local o remota de WordPress.
2. Ve a **Apariencia > Temas** dentro del panel de administración (wp-admin).
3. Localiza el tema **marcosdicaprio.dev** y haz clic en **Activar**.

## Autor

Desarrollado y mantenido por **Marcos DiCaprio**.
