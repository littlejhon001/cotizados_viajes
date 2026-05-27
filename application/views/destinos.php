<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<?php
$totalDestinos = !empty($destinos) ? count($destinos) : 0;
$totalVehiculos = !empty($vehiculos) ? count($vehiculos) : 0;
$totalTarifas = 0;
if (!empty($destinos)) {
	foreach ($destinos as $destinoCount) {
		$totalTarifas += !empty($destinoCount->tarifas_count) ? $destinoCount->tarifas_count : 0;
	}
}
?>

<style>
	@import url('https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap');
	@import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&display=swap');

	:root {
		--ink-900: #1A1A1A;
		--ink-700: #2b2b2b;
		--ink-500: #555555;
		--accent-500: #D4AF37;
		--accent-600: #b9962f;
		--glass-strong: rgba(255, 255, 255, 0.97);
		--shadow-soft: 0 12px 30px rgba(26, 26, 26, 0.12);
		--shadow-strong: 0 18px 40px rgba(26, 26, 26, 0.18);
	}

	body {
		font-family: 'Manrope', sans-serif;
		color: var(--ink-900);
		background: linear-gradient(180deg, #ffffff 0%, #f7f5ef 100%);
	}

	.destinos-hero {
		position: relative;
		overflow: hidden;
		padding: 42px 0 88px;
		background:
			radial-gradient(900px 480px at 12% 10%, rgba(212, 175, 55, 0.18), transparent 58%),
			radial-gradient(700px 400px at 90% 0%, rgba(26, 26, 26, 0.08), transparent 50%),
			linear-gradient(180deg, #ffffff 0%, #f3f1ea 100%);
	}

	.destinos-hero::before,
	.destinos-hero::after {
		content: '';
		position: absolute;
		border-radius: 50%;
		pointer-events: none;
	}

	.destinos-hero::before {
		width: 320px;
		height: 320px;
		right: -120px;
		top: -120px;
		background: radial-gradient(circle, rgba(212, 175, 55, 0.16), transparent 68%);
	}

	.destinos-hero::after {
		width: 260px;
		height: 260px;
		left: -90px;
		bottom: -120px;
		background: radial-gradient(circle, rgba(26, 26, 26, 0.07), transparent 68%);
	}

	.hero-content {
		position: relative;
		z-index: 1;
	}

	.hero-kicker {
		display: inline-flex;
		align-items: center;
		gap: 10px;
		padding: 8px 16px;
		border-radius: 999px;
		background: rgba(212, 175, 55, 0.14);
		color: var(--ink-700);
		font-weight: 700;
		font-size: 13px;
		letter-spacing: 0.02em;
	}

	.hero-title {
		font-family: 'Sora', sans-serif;
		font-size: clamp(32px, 4vw, 60px);
		line-height: 1.05;
		font-weight: 800;
		color: var(--ink-900);
		max-width: 12ch;
		margin: 18px auto 0;
	}

	.hero-subtitle {
		max-width: 860px;
		margin: 16px auto 0;
		color: var(--ink-500);
		font-size: clamp(16px, 1.6vw, 19px);
		line-height: 1.65;
	}

	.hero-actions {
		display: flex;
		flex-wrap: wrap;
		justify-content: center;
		gap: 12px;
		margin-top: 28px;
	}

	.action-btn {
		display: inline-flex;
		align-items: center;
		gap: 10px;
		min-height: 48px;
		padding: 12px 20px;
		border-radius: 999px;
		border: 1px solid transparent;
		font-weight: 700;
		text-decoration: none;
		transition: transform 180ms ease, box-shadow 180ms ease, background 180ms ease, color 180ms ease;
	}

	.action-btn:hover {
		transform: translateY(-1px);
	}

	.action-primary {
		background: var(--accent-500);
		color: var(--ink-900);
		box-shadow: var(--shadow-soft);
	}

	.action-primary:hover {
		background: var(--accent-600);
		color: var(--ink-900);
	}

	.action-secondary {
		background: rgba(26, 26, 26, 0.04);
		color: var(--ink-900);
		border-color: rgba(26, 26, 26, 0.12);
	}

	.destinos-shell {
		margin-top: -52px;
		padding-bottom: 56px;
	}

	.surface-panel {
		background: var(--glass-strong);
		border: 1px solid rgba(255, 255, 255, 0.75);
		border-radius: 28px;
		box-shadow: var(--shadow-strong);
		backdrop-filter: blur(14px);
		overflow: hidden;
	}

	.section-title {
		font-family: 'Sora', sans-serif;
		font-size: clamp(24px, 2.4vw, 36px);
		font-weight: 800;
		margin: 0;
		color: var(--ink-900);
	}

	.section-lead {
		color: var(--ink-500);
		margin-top: 10px;
		margin-bottom: 0;
		line-height: 1.65;
		max-width: 76ch;
	}

	.stat-card {
		display: flex;
		gap: 14px;
		align-items: flex-start;
		padding: 18px;
		border-radius: 20px;
		background: rgba(26, 26, 26, 0.03);
		border: 1px solid rgba(26, 26, 26, 0.06);
		height: 100%;
	}

	.stat-card i {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		width: 46px;
		height: 46px;
		border-radius: 16px;
		background: rgba(212, 175, 55, 0.16);
		color: var(--ink-900);
		font-size: 1.2rem;
		flex: 0 0 auto;
	}

	.stat-card h3 {
		margin: 0;
		font-size: 15px;
		font-weight: 800;
		color: var(--ink-900);
	}

	.stat-card p {
		margin: 4px 0 0;
		color: var(--ink-500);
		line-height: 1.5;
		font-size: 14px;
	}

	.destino-card {
		border-radius: 24px;
		background: #fff;
		box-shadow: var(--shadow-soft);
		border: 1px solid rgba(26, 26, 26, 0.08);
		overflow: hidden;
		height: 100%;
	}

	.destino-cover {
		min-height: 180px;
		background:
			linear-gradient(135deg, rgba(26, 26, 26, 0.82), rgba(26, 26, 26, 0.48)),
			radial-gradient(circle at top left, rgba(212, 175, 55, 0.22), transparent 40%),
			linear-gradient(135deg, #2b2b2b, #151515);
		color: #fff;
		padding: 22px;
		display: flex;
		flex-direction: column;
		justify-content: space-between;
	}

	.destino-badge {
		display: inline-flex;
		align-items: center;
		gap: 8px;
		width: fit-content;
		padding: 8px 12px;
		border-radius: 999px;
		background: rgba(255, 255, 255, 0.12);
		backdrop-filter: blur(8px);
		font-size: 12px;
		font-weight: 700;
	}

	.destino-cover h3 {
		margin: 14px 0 6px;
		font-family: 'Sora', sans-serif;
		font-size: 24px;
		font-weight: 800;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
	}

	.destino-cover p {
		margin: 0;
		color: rgba(255, 255, 255, 0.84);
		line-height: 1.55;
	}

	.destino-body {
		padding: 22px;
	}

	.price-strip {
		display: flex;
		flex-wrap: wrap;
		gap: 10px;
		margin: 16px 0 0;
	}

	.price-chip {
		display: inline-flex;
		align-items: center;
		gap: 8px;
		padding: 8px 12px;
		border-radius: 999px;
		background: rgba(212, 175, 55, 0.12);
		color: var(--ink-700);
		font-size: 13px;
		font-weight: 700;
	}

	.meta-grid {
		display: grid;
		grid-template-columns: repeat(2, minmax(0, 1fr));
		gap: 12px;
		margin-top: 16px;
	}

	.meta-item {
		padding: 14px;
		border-radius: 16px;
		background: rgba(26, 26, 26, 0.03);
		border: 1px solid rgba(26, 26, 26, 0.06);
	}

	.meta-item small {
		display: block;
		color: var(--ink-500);
		font-weight: 700;
		text-transform: uppercase;
		letter-spacing: 0.04em;
		margin-bottom: 6px;
	}

	.meta-item strong {
		color: var(--ink-900);
		font-size: 15px;
	}

	.btn-cotizar {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		gap: 10px;
		min-height: 48px;
		padding: 12px 18px;
		border-radius: 999px;
		background: var(--accent-500);
		color: var(--ink-900);
		font-weight: 800;
		text-decoration: none;
		margin-top: 18px;
		width: 100%;
	}

	.btn-cotizar:hover {
		background: var(--accent-600);
		color: var(--ink-900);
	}

	.btn-secondary-outline {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		gap: 10px;
		min-height: 48px;
		padding: 12px 18px;
		border-radius: 999px;
		background: rgba(26, 26, 26, 0.04);
		color: var(--ink-900);
		border: 1px solid rgba(26, 26, 26, 0.12);
		font-weight: 800;
		text-decoration: none;
		width: 100%;
		margin-top: 12px;
	}

	.info-panel {
		border-radius: 24px;
		background: #fff;
		box-shadow: var(--shadow-soft);
		border: 1px solid rgba(26, 26, 26, 0.08);
		padding: 22px;
	}

	.list-check {
		list-style: none;
		padding: 0;
		margin: 16px 0 0;
	}

	.list-check li {
		display: flex;
		gap: 10px;
		align-items: flex-start;
		padding: 10px 0;
		border-bottom: 1px dashed rgba(26, 26, 26, 0.12);
		color: var(--ink-700);
	}

	.list-check li:last-child {
		border-bottom: 0;
	}

	.list-check i {
		color: var(--accent-500);
		font-size: 18px;
		margin-top: 2px;
	}

	.price-table {
		width: 100%;
		border-collapse: separate;
		border-spacing: 0 10px;
		margin-top: 10px;
	}

	.price-table td {
		padding: 12px 14px;
		background: rgba(26, 26, 26, 0.03);
		border-top: 1px solid rgba(26, 26, 26, 0.06);
		border-bottom: 1px solid rgba(26, 26, 26, 0.06);
		color: var(--ink-700);
	}

	.price-table tr td:first-child {
		border-left: 1px solid rgba(26, 26, 26, 0.06);
		border-top-left-radius: 14px;
		border-bottom-left-radius: 14px;
		font-weight: 700;
	}

	.price-table tr td:last-child {
		border-right: 1px solid rgba(26, 26, 26, 0.06);
		border-top-right-radius: 14px;
		border-bottom-right-radius: 14px;
		text-align: right;
		font-weight: 800;
		color: var(--ink-900);
		white-space: nowrap;
	}

	.empty-state {
		padding: 22px;
		border-radius: 22px;
		background: rgba(26, 26, 26, 0.03);
		border: 1px dashed rgba(26, 26, 26, 0.16);
		color: var(--ink-500);
	}

	.sticky-column {
		position: sticky;
		top: 112px;
	}

	@media (max-width: 991.98px) {
		.sticky-column {
			position: static;
		}

		.destinos-shell {
			margin-top: -26px;
		}
	}

	@media (max-width: 767.98px) {
		.destinos-hero {
			padding-top: 28px;
			padding-bottom: 70px;
		}

		.hero-title {
			max-width: 100%;
		}

		.meta-grid {
			grid-template-columns: 1fr;
		}
	}
</style>

<section class="destinos-hero">
	<div class="container hero-content text-center animate__animated animate__fadeInUp animate__slow">
		<div class="hero-kicker mx-auto">
			<i class="bi bi-geo-alt-fill"></i>
			Destinos, rutas y cotización instantánea
		</div>
		<h1 class="hero-title animate__animated animate__fadeInUp animate__delay-1s animate__slow">Explora destinos con tarifas claras</h1>
		<p class="hero-subtitle animate__animated animate__fadeInUp animate__delay-1s animate__slow">
			Descubre los destinos disponibles, revisa precios por día y vehículo, y salta al cotizador cuando estés listo para calcular tu viaje.
			Esta página reutiliza la misma base de datos del cotizador para mostrar información real y facilitar la decisión del usuario.
		</p>
		<div class="hero-actions animate__animated animate__fadeInUp animate__delay-1s animate__slow">
			<a class="action-btn action-primary" href="<?php echo IP_SERVER; ?>#cotizacion">
				<i class="bi bi-calculator-fill"></i>
				Ir al cotizador
			</a>
			<a class="action-btn action-secondary" href="<?php echo IP_SERVER; ?>contacto">
				<i class="bi bi-whatsapp"></i>
				Hablar con un asesor
			</a>
		</div>
	</div>
</section>

<div class="container destinos-shell">
	<div class="surface-panel p-0">
		<div class="p-4 p-lg-5">
			<div class="row g-3 align-items-stretch">
				<div class="col-lg-4 col-md-6">
					<div class="stat-card animate__animated animate__fadeInUp">
						<i class="bi bi-lightning-charge-fill"></i>
						<div>
							<h3>Consulta rápida</h3>
							<p>Tarifas y destinos visibles en una sola pantalla para comparar más fácil.</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="stat-card animate__animated animate__fadeInUp animate__delay-1s">
						<i class="bi bi-shield-check"></i>
						<div>
							<h3>Información real</h3>
							<p>La información sale de la misma base que usa el cotizador del sitio.</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-12">
					<div class="stat-card animate__animated animate__fadeInUp animate__delay-2s">
						<i class="bi bi-phone"></i>
						<div>
							<h3>Listo para móvil</h3>
							<p>Diseño responsive con CTA claros para seguir al cotizador o WhatsApp.</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row g-4 px-3 px-lg-4 pb-4 pb-lg-5 pt-2">
			<div class="col-lg-8">
				<div class="info-panel animate__animated animate__fadeInLeft mb-4">
					<span class="section-label d-inline-flex mb-3"><i class="bi bi-stars"></i> Rutas frecuentes</span>
					<h2 class="section-title">Rutas frecuentes desde Bogotá</h2>
					<p class="section-lead">Estas rutas son las mas consultadas. Si deseas una cotizacion rapida, pasa al cotizador.</p>
					<ul class="list-check">
						<li><i class="bi bi-check-circle-fill"></i><span>Bogotá - Zipaquirá</span></li>
						<li><i class="bi bi-check-circle-fill"></i><span>Bogotá - Guatavita</span></li>
						<li><i class="bi bi-check-circle-fill"></i><span>Bogotá - Andrés Carne de Res Chía</span></li>
						<li><i class="bi bi-check-circle-fill"></i><span>Bogotá - Villa de Leiva</span></li>
					</ul>
					<a class="btn-cotizar" href="<?php echo IP_SERVER; ?>#cotizacion">
						<i class="bi bi-calculator-fill"></i>
						Cotizar estas rutas
					</a>
				</div>
				<div class="info-panel animate__animated animate__fadeInLeft">
					<span class="section-label d-inline-flex mb-3"><i class="bi bi-signpost-split-fill"></i> Destinos disponibles</span>
					<h2 class="section-title">Destinos destacados para cotizar tu viaje</h2>
					<p class="section-lead">Cada tarjeta resume el destino, su relación con los precios existentes y un acceso directo al cotizador para que el usuario pase de explorar a calcular en segundos.</p>

					<div class="row g-4 mt-1">
						<?php if (!empty($destinos)) { ?>
							<?php foreach ($destinos as $index => $destino) { ?>
								<div class="col-md-6">
									<article class="destino-card animate__animated animate__fadeInUp animate__delay-1s">
										<div class="destino-cover">
											<div class="destino-badge"><i class="bi bi-geo-alt-fill"></i> Destino <?php echo $index + 1; ?></div>
											<div>
												<h3><?php echo $destino->destino; ?></h3>
												<p>Consulta tarifas, compara vehículos y continúa al cotizador para calcular tu viaje con datos reales.</p>
											</div>
										</div>
										<div class="destino-body">
											<div class="price-strip">
												<span class="price-chip"><i class="bi bi-receipt"></i> <?php echo $destino->tarifas_count; ?> tarifas</span>
												<span class="price-chip"><i class="bi bi-car-front-fill"></i> <?php echo count($vehiculos); ?> vehículos</span>
											</div>

											<div class="meta-grid">
												<div class="meta-item">
													<small>Disponibilidad</small>
													<strong>Consulta inmediata</strong>
												</div>
												<div class="meta-item">
													<small>Acción</small>
													<strong>Ir al cotizador</strong>
												</div>
											</div>

											<?php if (!empty($destino->precios)) { ?>
												<table class="price-table">
													<tbody>
													<?php
													$countRows = 0;
													foreach ($destino->precios as $dia => $vehiculosTarifa) {
														foreach ($vehiculosTarifa as $idVehiculo => $tarifa) {
															$nombreVehiculo = 'Vehículo ' . $idVehiculo;
															foreach ($vehiculos as $vehiculo) {
																if ((string) $vehiculo->id === (string) $idVehiculo) {
																	$nombreVehiculo = $vehiculo->vehiculo;
																	break;
																}
															}
													?>
														<tr>
															<td><?php echo $nombreVehiculo; ?> - <?php echo $dia; ?> día(s)</td>
															<td><?php echo $tarifa; ?></td>
														</tr>
													<?php
															$countRows++;
															if ($countRows >= 3) {
																break 2;
															}
														}
													}
													?>
													</tbody>
												</table>
											<?php } else { ?>
												<div class="empty-state mt-3">
													Este destino aún no tiene tarifas visibles. Puedes usar el cotizador para obtener el valor exacto.
												</div>
											<?php } ?>

											<a class="btn-cotizar" href="<?php echo IP_SERVER; ?>#cotizacion">
												<i class="bi bi-calculator-fill"></i>
												Cotizar este destino
											</a>
											<a class="btn-secondary-outline" href="<?php echo IP_SERVER; ?>contacto">
												<i class="bi bi-whatsapp"></i>
												Pedir ayuda por WhatsApp
											</a>
										</div>
									</article>
								</div>
							<?php } ?>
						<?php } else { ?>
							<div class="col-12">
								<div class="empty-state">
									No hay destinos cargados todavía. Cuando agregues datos en la base, aquí aparecerán las tarjetas con su información y precios.
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="sticky-column">
					<div class="info-panel animate__animated animate__fadeInRight">
						<span class="section-label d-inline-flex mb-3"><i class="bi bi-calculator-fill"></i> Cotizador</span>
						<h2 class="section-title">Cotiza en el mismo flujo del sitio</h2>
						<p class="section-lead">Si ya tienes el destino claro, pasa al cotizador y define vehículo y días. Si aún comparas opciones, usa esta página para orientar al usuario antes de decidir.</p>

						<ul class="list-check">
							<li><i class="bi bi-check-circle-fill"></i><span>Selecciona destino, vehículo y duración.</span></li>
							<li><i class="bi bi-check-circle-fill"></i><span>Recibe el precio al instante.</span></li>
							<li><i class="bi bi-check-circle-fill"></i><span>Envía la cotización por correo o WhatsApp.</span></li>
							<li><i class="bi bi-check-circle-fill"></i><span>Comparte tu información con un asesor si necesitas ayuda.</span></li>
						</ul>

						<a class="btn-cotizar" href="<?php echo IP_SERVER; ?>#cotizacion">
							<i class="bi bi-arrow-right-circle"></i>
							Abrir cotizador
						</a>
						<a class="btn-secondary-outline" href="<?php echo IP_SERVER; ?>contacto">
							<i class="bi bi-headset"></i>
							Contactar asesor
						</a>
					</div>

					<div class="info-panel mt-4 animate__animated animate__fadeInRight animate__delay-1s">
						<span class="section-label d-inline-flex mb-3"><i class="bi bi-stars"></i> Cómo usar esta página</span>
						<h2 class="section-title">Ruta sugerida para el usuario</h2>
						<p class="section-lead">La navegación recomendada es: explorar destinos, comparar las tarjetas, abrir el cotizador y, si hace falta, escribir por WhatsApp.</p>
						<div class="meta-grid mt-3">
							<div class="meta-item">
								<small>Paso 1</small>
								<strong>Explorar destinos</strong>
							</div>
							<div class="meta-item">
								<small>Paso 2</small>
								<strong>Ir al cotizador</strong>
							</div>
							<div class="meta-item">
								<small>Paso 3</small>
								<strong>Recibir precio</strong>
							</div>
							<div class="meta-item">
								<small>Paso 4</small>
								<strong>Contactar asesor</strong>
							</div>
						</div>
					</div>

					<div class="info-panel mt-4 animate__animated animate__fadeInRight animate__delay-2s">
						<span class="section-label d-inline-flex mb-3"><i class="bi bi-graph-up-arrow"></i> Resumen de datos</span>
						<h2 class="section-title">Lo que hoy puede mostrar la página</h2>
						<div class="meta-grid mt-3">
							<div class="meta-item">
								<small>Destinos</small>
								<strong><?php echo $totalDestinos; ?></strong>
							</div>
							<div class="meta-item">
								<small>Vehículos</small>
								<strong><?php echo $totalVehiculos; ?></strong>
							</div>
							<div class="meta-item">
								<small>Tarifas</small>
								<strong><?php echo $totalTarifas; ?></strong>
							</div>
							<div class="meta-item">
								<small>Canal rápido</small>
								<strong>WhatsApp</strong>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
