<?php
/**
 * Template Name: Jotaele Landing
 * Template Post Type: page
 */

get_header();

$post_id = get_queried_object_id();
$contact_fields = array(
	array(
		'key' => 'Email',
		'label' => 'Contáctame por Email',
		'type' => 'email',
		'icon' => 'mail.svg',
	),
	array(
		'key' => 'Twitter',
		'label' => 'Twitter',
		'base' => 'https://twitter.com/',
		'icon' => 'twitter.svg',
	),
	array(
		'key' => 'GitHub',
		'label' => 'GitHub',
		'base' => 'https://github.com/',
		'icon' => 'github.svg',
	),
	array(
		'key' => 'LinkedIn',
		'label' => 'LinkedIn',
		'base' => 'https://www.linkedin.com/in/',
		'icon' => 'linkedin.svg',
	),
	array(
		'key' => 'Telegram',
		'label' => 'Telegram',
		'base' => 'https://t.me/',
		'icon' => 'telegram.svg',
	),
	array(
		'key' => 'Bluesky',
		'label' => 'BlueSky',
		'base' => 'https://bsky.app/profile/',
		'icon' => 'bluesky.svg',
	),
	array(
		'key' => 'Mi Tren',
		'label' => '¿Dónde está mi tren?',
		'icon' => 'mitren.svg',
	),
);

$contacts = array();
$seo_email = '';
$seo_same_as = array();
foreach ( $contact_fields as $field ) {
	$raw = get_post_meta( $post_id, $field['key'], true );
	if ( empty( $raw ) ) {
		$fallback_key = strtolower( str_replace( ' ', '_', $field['key'] ) );
		$raw = get_post_meta( $post_id, $fallback_key, true );
	}
	if ( empty( $raw ) ) {
		continue;
	}

	if ( isset( $field['type'] ) && 'email' === $field['type'] ) {
		$email = sanitize_email( $raw );
		if ( empty( $email ) ) {
			continue;
		}
		$href = 'mailto:' . $email;
		$seo_email = $email;
		$is_external = false;
	} else {
		$value = trim( $raw );
		if ( ! empty( $field['base'] ) ) {
			if ( preg_match( '#^https?://#i', $value ) ) {
				$href = $value;
			} else {
				$href = $field['base'] . ltrim( $value, '@' );
			}
		} else {
			if ( preg_match( '#^[a-z][a-z0-9+.-]*://#i', $value ) ) {
				$href = $value;
			} else {
				$href = 'https://' . ltrim( $value, '/' );
			}
		}
		$is_external = true;
		if ( preg_match( '#^https?://#i', $href ) ) {
			$seo_same_as[] = $href;
		}
	}

	$icon_file = ! empty( $field['icon'] ) ? $field['icon'] : '';
	if ( ! empty( $icon_file ) ) {
		if ( ! file_exists( get_stylesheet_directory() . '/img/' . $icon_file ) ) {
			$icon_file = '';
		}
	}

	$contacts[] = array(
		'label' => $field['label'],
		'href' => $href,
		'icon_file' => $icon_file,
		'class' => sanitize_title( $field['label'] ),
		'external' => $is_external,
	);
}

$seo_schema = array(
	'@context' => 'https://schema.org',
	'@type' => 'Person',
	'name' => get_bloginfo( 'name' ),
	'url' => home_url( '/' ),
);
$description = get_bloginfo( 'description' );
if ( ! empty( $description ) ) {
	$seo_schema['description'] = $description;
}
if ( ! empty( $seo_email ) ) {
	$seo_schema['email'] = 'mailto:' . $seo_email;
}
if ( ! empty( $seo_same_as ) ) {
	$seo_schema['sameAs'] = array_values( array_unique( $seo_same_as ) );
}
?>

<main id="primary" class="site-main jotaele-landing">
	<section class="landing-hero">
		<div class="landing-hero__inner">
			<h1 class="landing-hero__title">
					<span class="screen-reader-text"><?php echo esc_html__( 'Jotaele', 'jotaele' ); ?></span>
					<?php
					$logo_path = get_stylesheet_directory() . '/img/jotaele_wh.svg';
					if ( file_exists( $logo_path ) ) {
						$logo_svg = file_get_contents( $logo_path );
						if ( $logo_svg ) {
							$logo_svg = preg_replace( '/<\?xml[^>]*\?>/i', '', $logo_svg );
							$logo_svg = preg_replace( '/<!--.*?-->/s', '', $logo_svg, 1 );
							$logo_svg = preg_replace(
								'/<svg\b([^>]*)>/',
								'<svg$1 class="jotaele-logo" role="button" tabindex="0" aria-label="' . esc_attr__( 'Jotaele', 'jotaele' ) . '">',
								$logo_svg,
								1
							);
							echo $logo_svg; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						}
					} else {
						?>
						<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/jotaele_wh.svg' ); ?>" alt="<?php echo esc_html__( 'Jotaele', 'jotaele' ); ?>"/>
						<?php
					}
					?>
				</h1>
			<div class="landing-hero__lead"><?php the_content(); ?></div>
			<?php if ( ! empty( $contacts ) ) : ?>
				<button class="landing-contact__toggle screen-reader-text" type="button" aria-controls="landing-contact" aria-expanded="false">
					<?php echo esc_html__( 'Mostrar contacto', 'jotaele' ); ?>
				</button>
				<div id="landing-contact" class="landing-contact" aria-label="<?php echo esc_attr__( 'Contacto', 'jotaele' ); ?>" aria-hidden="true">
					<?php foreach ( $contacts as $contact ) : ?>
						<a class="landing-contact__link landing-contact__link--<?php echo esc_attr( $contact['class'] ); ?>" href="<?php echo esc_url( $contact['href'] ); ?>"<?php echo $contact['external'] ? ' target="_blank" rel="noopener me"' : ''; ?> aria-label="<?php echo esc_attr( $contact['label'] ); ?>">
							<span class="landing-contact__icon" aria-hidden="true">
								<?php if ( ! empty( $contact['icon_file'] ) ) : ?>
									<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/' . $contact['icon_file'] ); ?>" alt="" />
								<?php endif; ?>
							</span>
							<span class="screen-reader-text"><?php echo esc_html( $contact['label'] ); ?></span>
						</a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>

		<?php if ( ! empty( $seo_schema ) ) : ?>
			<script type="application/ld+json">
				<?php echo wp_json_encode( $seo_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ); ?>
			</script>
		<?php endif; ?>

		
		<script>
			document.addEventListener('DOMContentLoaded', function () {
				var body = document.querySelector('body.page-template-template-jotaele-landing');
				var inner = document.querySelector('.landing-hero__inner');
				var contact = document.querySelector('.landing-contact');
				var toggle = document.querySelector('.landing-contact__toggle');
				if (!body || !inner || !contact) {
					return;
				}

				var isReady = false;
				var queued = false;
				var revealed = false;
				var popEnabled = false;
				// Match CSS timings: logo (0.3s delay + 0.9s duration) and last word (2.0s delay + 0.6s duration).
				var logoDelayMs = 300;
				var logoDurationMs = 900;
				var wordLastDelayMs = 2000;
				var wordDurationMs = 600;
				var initialDelayMs = Math.max(logoDelayMs + logoDurationMs, wordLastDelayMs + wordDurationMs);

				var logo = document.querySelector('.jotaele-logo');
				if (logo) {
					var letters = Array.prototype.slice.call(logo.querySelectorAll('.st0, .st1'));
					var current = logo.querySelector('.st1');
					var originLetter = current;
					var swapLetter = function () {
						if (letters.length < 2) {
							return;
						}
						var candidates = letters.filter(function (node) { return node !== current; });
						var next = candidates[Math.floor(Math.random() * candidates.length)];
						if (current) {
							current.classList.remove('st1');
							current.classList.add('st0');
							current.classList.remove('is-pop');
						}
						if (next) {
							next.classList.remove('st0');
							next.classList.add('st1');
							next.classList.add('is-pop');
							setTimeout(function () { next.classList.remove('is-pop'); }, 260);
							current = next;
						}
						if (popBuffer) {
							playPopSound();
						} else if (popPromise) {
							popPromise.then(function () {
								playPopSound();
							});
						}
						if (idleTimer) {
							clearTimeout(idleTimer);
						}
						idleTimer = setTimeout(resetToOrigin, 4000);
					};
					var idleTimer = null;
					var resetToOrigin = function () {
						if (current === originLetter) {
							return;
						}
						logo.classList.add('is-resetting');
						current.classList.remove('st1');
						current.classList.add('st0');
						originLetter.classList.remove('st0');
						originLetter.classList.add('st1');
						current = originLetter;
						setTimeout(function () {
							logo.classList.remove('is-resetting');
						}, 500);
					};
					var lastSwapTime = 0;
					var triggerSwap = function (event) {
						if (!popEnabled) {
							return;
						}
						var now = Date.now();
						if (now - lastSwapTime < 300) {
							if (event) {
								event.preventDefault();
							}
							return;
						}
						lastSwapTime = now;
						if (event) {
							event.preventDefault();
						}
						swapLetter();
					};
					logo.addEventListener('click', triggerSwap);
					logo.addEventListener('touchstart', triggerSwap, { passive: false });
					logo.addEventListener('keydown', function (event) {
						if (event.key === 'Enter' || event.key === ' ') {
							event.preventDefault();
							triggerSwap();
						}
					});
				}


				var audioContext = null;
				var audioBuffer = null;
				var audioPromise = null;
				var popBuffer = null;
				var popPromise = null;
				var soundUrl = "<?php echo esc_url( get_stylesheet_directory_uri() . '/img/revealsound.mp3' ); ?>";
				var popSoundUrl = "<?php echo esc_url( get_stylesheet_directory_uri() . '/img/popsound.mp3' ); ?>";

				// Preload: fetch audio bytes immediately, before any user gesture.
				var revealFetch = soundUrl ? fetch(soundUrl).then(function (r) {
					return r.ok ? r.arrayBuffer() : Promise.reject();
				}).catch(function () { return null; }) : null;
				var popFetch = popSoundUrl ? fetch(popSoundUrl).then(function (r) {
					return r.ok ? r.arrayBuffer() : Promise.reject();
				}).catch(function () { return null; }) : null;

				var preparePopSound = function () {
					if (popPromise || !popSoundUrl || !audioContext) {
						return popPromise;
					}
					popPromise = popFetch
						.then(function (buffer) {
							if (!buffer) { throw new Error('Pop sound load failed'); }
							return new Promise(function (resolve, reject) {
								audioContext.decodeAudioData(buffer, resolve, reject);
							});
						})
						.then(function (decoded) {
							popBuffer = decoded;
							return decoded;
						})
						.catch(function () {
							return null;
						});
					return popPromise;
				};

				var initAudio = function () {
					if (audioContext) { return; }
					var AudioCtx = window.AudioContext || window.webkitAudioContext;
					if (!AudioCtx) { return; }
					audioContext = new AudioCtx();
					audioContext.resume();
					prepareSound();
					preparePopSound();
				};

				var prepareSound = function () {
					if (audioPromise || !soundUrl || !audioContext) {
						return audioPromise;
					}
					audioPromise = revealFetch
						.then(function (buffer) {
							if (!buffer) { throw new Error('Sound load failed'); }
							return new Promise(function (resolve, reject) {
								audioContext.decodeAudioData(buffer, resolve, reject);
							});
						})
						.then(function (decoded) {
							audioBuffer = decoded;
							return decoded;
						})
						.catch(function () {
							return null;
						});
					return audioPromise;
				};

				var playPopSound = function () {
					if (!audioContext || !popBuffer) {
						return;
					}
					if (audioContext.state === 'suspended') {
						audioContext.resume();
					}
					var source = audioContext.createBufferSource();
					var gain = audioContext.createGain();
					gain.gain.value = 0.324;
					source.buffer = popBuffer;
					source.connect(gain);
					gain.connect(audioContext.destination);
					source.start(0);
				};

				var playSound = function () {
					if (!audioContext || !audioBuffer) {
						return;
					}
					if (audioContext.state === 'suspended') {
						audioContext.resume();
					}
					var source = audioContext.createBufferSource();
					var gain = audioContext.createGain();
					gain.gain.value = 0.35;
					source.buffer = audioBuffer;
					source.connect(gain);
					gain.connect(audioContext.destination);
					source.start(0);
				};

				var reveal = function () {
					if (revealed) {
						return;
					}
					inner.classList.add('is-contact-visible');
					contact.setAttribute('aria-hidden', 'false');
					if (toggle) {
						toggle.setAttribute('aria-expanded', 'true');
					}
					revealed = true;
					if (audioBuffer) {
						playSound();
					} else if (audioPromise) {
						audioPromise.then(function () {
							playSound();
						});
					}
					var contactLinks = contact.querySelectorAll('.landing-contact__link');
					var lastLink = contactLinks.length ? contactLinks[contactLinks.length - 1] : null;
					if (lastLink) {
						var popHandled = false;
						var popFallback = setTimeout(function () {
							if (!popHandled) { popHandled = true; popEnabled = true; }
						}, 2000);
						lastLink.addEventListener('transitionend', function handler(e) {
							if (e.propertyName === 'opacity' && !popHandled) {
								popHandled = true;
								clearTimeout(popFallback);
								popEnabled = true;
								lastLink.removeEventListener('transitionend', handler);
							}
						});
					} else {
						popEnabled = true;
					}
				};

				var requestReveal = function () {
					if (revealed) {
						return;
					}
					prepareSound();
					preparePopSound();
					if (isReady) {
						reveal();
					} else {
						queued = true;
					}
				};

				setTimeout(function () {
					isReady = true;
					if (queued) {
						reveal();
					}
				}, initialDelayMs);

				body.addEventListener('click', initAudio);
				body.addEventListener('click', requestReveal);
				body.addEventListener('touchstart', requestReveal, { passive: true });
				body.addEventListener('touchend', initAudio, { passive: true });
				if (toggle) {
					toggle.addEventListener('click', requestReveal);
				}

				var startY = null;
				body.addEventListener('touchstart', function (event) {
					if (event.touches && event.touches.length === 1) {
						startY = event.touches[0].clientY;
					}
				}, { passive: true });

				body.addEventListener('touchend', function (event) {
					if (startY === null || !event.changedTouches || !event.changedTouches.length) {
						return;
					}
					var endY = event.changedTouches[0].clientY;
					if (startY - endY > 40) {
						requestReveal();
					}
					startY = null;
				});
			});
		</script>

	</section>
</main>

<?php
get_footer();
