<?php
// Validamos los atributos para evitar errores de renderizado
$product_name = isset($attributes['productName']) ? $attributes['productName'] : 'Producto Demo';
$price = isset($attributes['price']) ? $attributes['price'] : 0;

// Empaquetamos los datos que consumirá JavaScript (Interactivity API)
$product_data = wp_json_encode([
    'id'    => wp_unique_id('prod_'), // ID único por bloque
    'title' => $product_name,
    'price' => (float) $price
]);
?>

<div 
    data-wp-interactive="offline-commerce" 
    <?php echo wp_interactivity_data_wp_context( array( 'cart' => array() ) ); ?>
    class="wp-block-offline-commerce"
    style="font-family: system-ui, sans-serif; border: 1px solid #e0e0e0; border-radius: 12px; padding: 24px; max-width: 400px; margin: 20px auto; background: #ffffff; box-shadow: 0 4px 6px rgba(0,0,0,0.05);"
>
    <!-- 1. Tarjeta del Producto -->
    <div style="border-bottom: 2px dashed #eeeeee; padding-bottom: 20px; margin-bottom: 20px;">
        <h3 style="margin: 0 0 10px 0; font-size: 1.5rem; color: #1e1e1e;">
            <?php echo esc_html($product_name); ?>
        </h3>
        <p style="margin: 0 0 20px 0; font-size: 1.25rem; color: #555555;">
            Precio: <strong>C$<?php echo esc_html($price); ?></strong>
        </p>
        
        <button 
            data-product='<?php echo esc_attr($product_data); ?>'
            data-wp-on--click="actions.addToCart"
            style="background: #111111; color: #ffffff; border: none; padding: 12px 24px; border-radius: 6px; font-size: 1rem; cursor: pointer; width: 100%; font-weight: bold;"
        >
            🛒 Agregar al Carrito
        </button>
    </div>

    <!-- 2. Interfaz del Carrito (Reactiva y Condicional) -->
    <div 
        data-wp-bind--hidden="state.isCartEmpty" 
        style="background: #f0fdf4; border: 1px solid #bbf7d0; padding: 20px; border-radius: 8px;"
    >
        <h4 style="margin: 0 0 10px 0; color: #166534; font-size: 1.1rem;">Resumen de tu pedido</h4>
        <p style="margin: 0 0 15px 0; font-size: 1.2rem; color: #15803d;">
            Total a pagar: <strong>C$<span data-wp-text="state.cartTotal">0</span></strong>
        </p>
        
        <button 
            data-wp-on--click="actions.checkoutWhatsApp"
            style="background: #25D366; color: #ffffff; border: none; padding: 12px; border-radius: 6px; font-size: 1rem; cursor: pointer; width: 100%; display: flex; justify-content: center; align-items: center; gap: 8px; font-weight: bold;"
        >
            <!-- SVG Nativo de WhatsApp -->
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/>
            </svg>
            Enviar por WhatsApp
        </button>
    </div>
</div>