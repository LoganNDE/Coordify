# 📅 Coordify

Coordify es una plataforma web desarrollada con Laravel que permite a organizadores y asistentes gestionar eventos de forma fácil y rápida. Desde la creación de eventos hasta la venta de entradas con código QR y pasarela de pago, Coordify ofrece una solución integral para experiencias en vivo.

🌐 Proyecto en producción: [coordify.logannr.me](https://coordify.logannr.me)

## 🚀 Funcionalidades principales

- ✅ Creación de eventos con imagen, descripción, fecha, hora y ubicación
- 🎟️ Venta de entradas con integración de Stripe
- 🔐 Registro de usuarios y autenticación (Google y correo)
- 📩 Confirmación de compra por email con ticket adjunto
- 📲 Generación automática de códigos QR únicos por entrada
- 📋 Escaneo de QR para validación de asistencia en el evento
- 📊 Panel de administración para organizadores
- 🗃️ Sistema de planes y suscripciones
- 🌍 Interfaz amigable y responsiva

## 🛠️ Tecnologías utilizadas

- Backend: Laravel 12
- Frontend: Blade + Tailwind CSS + JavaScript
- Base de datos: MySQL (MariaDB)
- Pasarela de pago: Stripe Checkout
- Otros: Vite, Google OAuth, qrcode-html5, Simple QrCode

## 🧪 Estructura general

```
Coordify-main/
├── app/Http/Controllers/     # Lógica del servidor (eventos, pagos, QR, usuarios)
├── app/Models/               # Modelos de base de datos
├── resources/views/          # Vistas con Blade
├── routes/web.php            # Rutas de la aplicación
├── public/                   # Archivos accesibles (imágenes, CSS compilado, JS)
└── ...
```

## ⚙️ Cómo instalar

1. Clona el repositorio y accede al directorio:

```bash
git clone https://github.com/tuusuario/Coordify.git
cd Coordify
```

2. Instala las dependencias:

```bash
composer install
npm install && npm run build
```

3. Copia el archivo `.env.example` a `.env` y configura tus variables de entorno:

```bash
cp .env.example .env
php artisan key:generate
```

4. Configura la base de datos y ejecuta las migraciones:

```bash
php artisan migrate --seed
```

5. Levanta el servidor local:

```bash
php artisan serve
```

## 🔒 Seguridad y privacidad

- Los pagos están protegidos mediante Stripe Checkout.
- Los códigos QR se generan de forma segura y son únicos por participante.
- Los datos del usuario se almacenan de acuerdo con buenas prácticas de cifrado y validación.

## 👤 Autor

Desarrollado por **Logan Naranjo**  
📧 info@coordify.logannr.me

## 📄 Licencia

Este proyecto está bajo la licencia MIT.
