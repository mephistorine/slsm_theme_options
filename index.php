<?php
/* Plugin Name: Options and Settings API
 * Description: Настройки для WP
 * Version: 1.0
 * Author:  stylesam
 * Author URI: http://stylesam.com
 */



class SLSMApi
{
	/**
	 * SLSMApi constructor.
	 */
	public function __construct()
	{
		add_action('admin_menu', [$this, 'slsm_admin_menu']);

		add_action('admin_init', [$this, 'slsm_admin_settings']);
	}

	public function slsm_admin_settings()
	{
		register_setting( 'slsm_theme_options_group', 'slsm_theme_options', [
			'sanitize_callback' => [$this, 'slsm_theme_options_sanitize']
		]);

		add_settings_section('slsm_theme_options_section_id', 'Секция Опции темы', '', 'slsm-theme-options');
		add_settings_field(
			'slsm_theme_options_body_id',
			'Цвет фона',
			[$this, 'slsm_theme_options_body_cb'],
			'slsm-theme-options',
			'slsm_theme_options_section_id',
			['label_for' => 'slsm_theme_options_body_id']
		);
		add_settings_field(
			'slsm_theme_options_header_id',
			'Цвет header',
			[$this, 'slsm_theme_options_header_cb'],
			'slsm-theme-options',
			'slsm_theme_options_section_id',
			['label_for' => 'slsm_theme_options_header_id']
		);
	}

	public function slsm_theme_options_body_cb()
	{
		$options = get_option('slsm_theme_options');
		?>
		<input
			type="text"
			title=""
			name="slsm_theme_options[slsm_theme_options_body]"
			id="slsm_theme_options_body_id"
			value="<?php echo esc_attr( $options['slsm_theme_options_body'] ); ?>"
			class="regular-text code"
		>
		<?php
	}

	public function slsm_theme_options_header_cb()
	{
		$options = get_option('slsm_theme_options');
		?>
		<input
			type="text"
			title=""
			name="slsm_theme_options[slsm_theme_options_header]"
			id="slsm_theme_options_header_id"
			value="<?php echo esc_attr( $options['slsm_theme_options_header'] ); ?>"
			class="regular-text code"
		>
		<?php
	}

	public function slsm_theme_options_sanitize( $options )
	{
		$clean_options = [];
		foreach ( $options as $k => $v )
		{
			$clean_options[$k] = strip_tags( $v );
		}

		return $clean_options;
	}

	public function slsm_admin_menu()
	{
		add_options_page(
			__('Опции темы'),
			__('Опции темы'),
			'manage_options',
			'slsm-theme-options', // or __FILE__
			[$this, 'slsm_page_options']
		);
	}

	public function slsm_page_options()
	{
		$options = get_option( 'slsm_theme_options' );

		?>
		<div class="wrap">
			<h2>Опции темы</h2>
			<p>Options and Settings API</p>

			<form action="options.php" method="post">
				<?php settings_fields( 'slsm_theme_options_group' ); ?>
				<?php do_settings_sections( 'slsm-theme-options' ); ?>
				<?php submit_button(); ?>
			</form>
		</div>
		<?php
	}
}

new SLSMApi();