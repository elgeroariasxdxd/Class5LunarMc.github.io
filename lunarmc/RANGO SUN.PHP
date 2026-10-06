<?php require_once __DIR__ . '/config.php'; ?>
<?php include 'includes/header.php'; ?>

<main class="main-container text-center">
    <section class="rank-details-section">
        
        <!-- ENCABEZADO DEL RANGO -->
        <div class="rank-header">
            <img src="sun rango.png" alt="Rango SUN" class="rank-header-img">
            <h1 class="rank-title">Rango SUN</h1>
            <div class="rank-pricing">
                <span class="product-price-old">9.97</span>
                <span class="product-price">2.99</span>
                <span class="product-currency">USD</span>
            </div>
            <a href="#" class="btn-add-cart-large">🛒 Agregar al Carrito</a>
        </div>

        <!-- SECCIÓN 1: RANGO PERMANENTE -->
        <div class="pixel-section">
            <div class="pixel-badge-container">
                <span class="pixel-badge">RANGO</span>
                <span class="pixel-badge">PERMANENTE</span>
            </div>
            <ul class="pixel-list">
                <li>👑 Obtendrás el prefijo <strong>SUN</strong> en tu nombre del Chat.</li>
                <li>👑 Obtendrás el prefijo <strong>SUN</strong> en tu nombre del Tabulador.</li>
                <li>👑 Rango PERMANENTE: lo compras una vez y es tuyo de por vida.</li>
            </ul>
        </div>

        <!-- SECCIÓN 2: QUE GANAS -->
        <div class="pixel-section">
            <div class="pixel-badge-container">
                <span class="pixel-badge">QUE</span>
                <span class="pixel-badge">GANAS</span>
            </div>
            <ul class="pixel-list">
                <li>💎 Obtendrás recompensas diarias de tu rango.</li>
                <li>💎 Obtendrás un kit especial de tu rango.</li>
                <li>💎 Acceso a una mina VIP exclusiva de tu rango.</li>
                <li>⚡ Acceso a más mochilas virtuales (1).</li>
                <li>⚡ Comando <code>/feed</code> para saciar el hambre.</li>
                <li>⚡ Comando <code>/near</code> para ver a los jugadores cercanos.</li>
                <li>⚡ Comando <code>/ec</code> para abrir el EnderChest remotamente.</li>
                <li>⚡ Prioridad en la cola para ingresar a las modalidades.</li>
            </ul>
        </div>

        <!-- SECCIÓN 3: ESTATUS Y RECOMPENSAS EXCLUSIVAS -->
        <div class="pixel-section">
            <div class="pixel-badge-container">
                <span class="pixel-badge">ESTATUS</span>
            </div>
            <ul class="pixel-list">
                <li>✅ Obtendrás todos los kill effects.</li>
                <li>⭐ Acceso a reclamar el kit exclusivo de tu rango (<code>/kit SUN</code>).</li>
            </ul>
            <div class="rank-media-box">
                <img src="chest-preview.png" alt="Previsualización Kit" class="pixel-img">
            </div>
            <ul class="pixel-list">
                <li>⭐ Acceso a la mina exclusiva de tu rango (<code>/warp SUN</code>).</li>
            </ul>
            <div class="rank-media-box">
                <img src="warp-sun-preview.png" alt="Mina SUN" class="pixel-img">
            </div>
        </div>

        <!-- SECCIÓN 4: DISCORD -->
        <div class="pixel-section">
            <div class="pixel-badge-container">
                <span class="pixel-badge">DISCORD</span>
            </div>
            <ul class="pixel-list">
                <li>👑 Obtendrás el rol <strong>SUN</strong> en nuestro Discord.</li>
                <li>👾 Rol VIP exclusivo en nuestro Discord, visible para toda la comunidad.</li>
                <li>👾 Acceso al chat privado reservado solo para VIPs.</li>
                <li>👾 Entérate de eventos, sorteos y novedades ANTES que nadie.</li>
            </ul>
        </div>

        <!-- SECCIÓN 5: TÉRMINOS Y CONDICIONES -->
        <div class="pixel-section warning-section">
            <h2 class="gold-heading">Términos y Condiciones</h2>
            <p class="info-text">Al comprar este producto, automáticamente aceptas lo siguiente:</p>
            <ul class="pixel-list warning-list">
                <li>⚠️ Confirmas haber leído los términos y condiciones.</li>
                <li>⚠️ Entiendes que no se aceptarán reembolsos bajo ninguna circunstancia.</li>
                <li>⚠️ Reconoces que el producto es personal e intransferible.</li>
                <li>⚠️ Certificas haber revisado todas las funciones del producto y que cumplen tus expectativas.</li>
            </ul>
        </div>

    </section>
</main>

<?php if (file_exists(__DIR__ . '/includes/footer.php')) include __DIR__ . '/includes/footer.php'; ?>
<script src="index-.js"></script>
</body>
</html>
