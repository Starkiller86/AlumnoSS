# AlumnoSS

Sistema de gestión de servicio social para alumnos desarrollado en PHP.

## 📋 Descripción

AlumnoSS es una aplicación web diseñada para la administración y seguimiento del servicio social estudiantil. El sistema permite a los estudiantes gestionar su documentación, registros y trámites relacionados con el servicio social de manera digital.

## 🚀 Tecnologías Utilizadas

- **PHP** - Backend principal (22.8%)
- **JavaScript** - Funcionalidad del cliente (2.1%)
- **CSS** - Estilos y diseño (0.3%)
- **Rich Text Format** - Documentación (74.7%)
- **Python** - Scripts auxiliares (0.1%)

## 📁 Estructura del Proyecto

```
AlumnoSS/
├── css/                  # Hojas de estilo
├── db/                   # Base de datos y scripts SQL
├── documents/            # Documentos y plantillas
├── ezpdf-master/         # Librería para generación de PDFs
├── fonts/                # Fuentes tipográficas
├── forms/                # Formularios del sistema
├── images/               # Recursos gráficos
├── js/                   # Scripts JavaScript
├── log/                  # Archivos de registro
├── php/                  # Scripts PHP del backend
├── pie/                  # Componentes del footer
├── principal/            # Módulo principal
├── index.php             # Punto de entrada de la aplicación
└── testgra.php           # Archivo de pruebas
```

## ⚙️ Requisitos del Sistema

- PHP 7.0 o superior
- Servidor web (Apache/Nginx)
- MySQL/MariaDB
- Navegador web moderno

## 🔧 Instalación

1. Clona el repositorio:
```bash
git clone https://github.com/Starkiller86/AlumnoSS.git
```

2. Configura tu servidor web para apuntar al directorio del proyecto

3. Importa la base de datos desde el directorio `db/`

4. Configura las credenciales de la base de datos en los archivos de configuración PHP

5. Asegúrate de que los permisos de escritura estén configurados para:
   - `/log`
   - `/documents`

## 💻 Uso

1. Accede a la aplicación a través de tu navegador:
```
http://localhost/AlumnoSS
```

2. Inicia sesión con tus credenciales

3. Navega por los diferentes módulos del sistema para:
   - Registrar información del servicio social
   - Generar documentos PDF
   - Consultar el historial
   - Administrar formularios

## 📄 Funcionalidades Principales

- **Gestión de alumnos**: Registro y administración de datos de estudiantes
- **Generación de PDFs**: Creación automática de documentos oficiales
- **Formularios dinámicos**: Sistema de formularios personalizables
- **Sistema de logs**: Seguimiento de actividades del sistema
- **Panel principal**: Dashboard con información relevante

## 🤝 Contribuciones

Las contribuciones son bienvenidas. Si deseas contribuir:

1. Haz fork del proyecto
2. Crea una rama para tu feature (`git checkout -b feature/NuevaCaracteristica`)
3. Commit tus cambios (`git commit -m 'Añadir nueva característica'`)
4. Push a la rama (`git push origin feature/NuevaCaracteristica`)
5. Abre un Pull Request

## 👥 Colaboradores

- [Starkiller86](https://github.com/Starkiller86)
- 1 colaborador adicional

## 📊 Estadísticas

- ⭐ 1 estrella
- 👀 1 observador
- 🔱 0 forks

## 📝 Licencia

Licencia sujeta al Centro Educativo y Cultural de Estado Querétaro
