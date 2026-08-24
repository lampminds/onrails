<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Sobre Nosotros',
                'slug' => 'sobre-nosotros',
                'content' => '<h2>Nuestra Historia</h2>
<p>Somos una empresa dedicada a brindar soluciones tecnológicas de alta calidad desde 2020. Nuestro compromiso es ofrecer productos y servicios que superen las expectativas de nuestros clientes.</p>

<h3>Nuestra Misión</h3>
<p>Proporcionar tecnología innovadora y confiable que impulse el crecimiento de nuestros clientes y mejore su calidad de vida.</p>

<h3>Nuestros Valores</h3>
<ul>
    <li><strong>Calidad:</strong> Nos comprometemos con la excelencia en cada producto y servicio.</li>
    <li><strong>Innovación:</strong> Buscamos constantemente nuevas soluciones tecnológicas.</li>
    <li><strong>Confianza:</strong> Construimos relaciones duraderas basadas en la transparencia.</li>
    <li><strong>Servicio:</strong> Nuestros clientes son nuestra prioridad número uno.</li>
</ul>

<h3>¿Por qué elegirnos?</h3>
<p>Con años de experiencia en el sector tecnológico, hemos desarrollado un profundo conocimiento de las necesidades del mercado. Nuestro equipo de expertos trabaja incansablemente para ofrecer soluciones que realmente marquen la diferencia.</p>',
                'active' => true,
            ],
            [
                'title' => 'Contacto',
                'slug' => 'contacto',
                'content' => '<h2>Póngase en Contacto con Nosotros</h2>
<p>Estamos aquí para ayudarle. No dude en contactarnos para cualquier consulta o información adicional.</p>

<h3>Información de Contacto</h3>
<div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0;">
    <p><strong>📍 Dirección:</strong> Río Cuarto, Córdoba, Argentina</p>
    <p><strong>📞 Teléfono:</strong> <a href="https://wa.me/5493584022516" target="_blank">+54 9 3584 02-2516</a></p>
    <p><strong>✉️ Email:</strong> <a href="mailto:info@onrails.com.ar">info@onrails.com.ar</a></p>
    <p><strong>🕒 Horarios de Atención:</strong> Lunes a Viernes de 9:00 a 18:00</p>
</div>

<h3>Formulario de Contacto</h3>
<p>Complete el formulario a continuación y nos pondremos en contacto con usted lo antes posible.</p>

<div style="background: #fff; border: 1px solid #ddd; padding: 20px; border-radius: 8px;">
    <p><em>Formulario de contacto disponible próximamente.</em></p>
</div>

<h3>Redes Sociales</h3>
<p>Síguenos en nuestras redes sociales para mantenerte actualizado con nuestras últimas novedades y ofertas especiales.</p>',
                'active' => true,
            ],
            [
                'title' => 'Política de Privacidad',
                'slug' => 'politica-privacidad',
                'content' => '<h2>Política de Privacidad</h2>
<p><strong>Última actualización:</strong> ' . date('d/m/Y') . '</p>

<h3>1. Información que Recopilamos</h3>
<p>Recopilamos información que usted nos proporciona directamente, como cuando crea una cuenta, realiza una compra o se pone en contacto con nosotros.</p>

<h3>2. Cómo Utilizamos su Información</h3>
<p>Utilizamos la información recopilada para:</p>
<ul>
    <li>Procesar sus pedidos y transacciones</li>
    <li>Proporcionar soporte al cliente</li>
    <li>Mejorar nuestros productos y servicios</li>
    <li>Enviar comunicaciones relacionadas con su cuenta</li>
</ul>

<h3>3. Protección de Datos</h3>
<p>Implementamos medidas de seguridad técnicas y organizativas para proteger su información personal contra acceso no autorizado, alteración, divulgación o destrucción.</p>

<h3>4. Sus Derechos</h3>
<p>Usted tiene derecho a:</p>
<ul>
    <li>Acceder a sus datos personales</li>
    <li>Rectificar información inexacta</li>
    <li>Solicitar la eliminación de sus datos</li>
    <li>Oponerse al procesamiento de sus datos</li>
</ul>

<h3>5. Contacto</h3>
<p>Si tiene preguntas sobre esta política de privacidad, puede contactarnos en <a href="mailto:info@onrails.com.ar">info@onrails.com.ar</a></p>',
                'active' => true,
            ],
        ];

        foreach ($pages as $pageData) {
            Page::create($pageData);
        }
    }
}
