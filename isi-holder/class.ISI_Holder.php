<?php
/**
 * ISI holder plugin.
 *
 * @category ISI Holder
 * @package  Plugin
 * @author   Fingerpaint Developers <devs@fingerpaintmarketing.com>
 * @license  Copyright 2015 Fingerpaint. All rights reserved.
 * @link     http://fingerpaintmarketing.com
 */

class ISI_Holder {
	public function __construct() {
		add_action('admin_menu', [ $this, 'action_isi_menu']);
		add_action('admin_init', [ $this, 'action_isi_settings_reg']);
	}


	public function action_isi_menu(){
		add_submenu_page(
			'options-general.php',
			__('Important Safety Information','fpmisi'),
			__('Important Safety Information','fpmisi'),
			'manage_options',
			'isi_settings',
			[ $this, 'isi_settings_render']
		);
	}


	public function action_isi_settings_reg(){
		register_setting( 'isi_options', 'hcp_isi' );
		register_setting( 'isi_options', 'consumer_isi' );
	}


	public function isi_settings_render(){
		if (!current_user_can('manage_options')) {return;}
		//output settings html
		?>
		<div class="wrap">
			<h1><?php _e('Important Safety Information Settings', 'fpmisi'); ?></h1>
			<form method="post" action="options.php">
				<?php
				settings_fields( 'isi_options' );
				do_settings_sections( 'isi_options' );
				$hcp_isi = get_option('hcp_isi');
				$consumer_isi = get_option('consumer_isi');
				?>
				<section>
					<h2><?php _e('Consumer ISI', 'fpmisi') ?></h2>
					<?php wp_editor( $consumer_isi, 'consumer_isi' ); ?>
					<div style="padding:10px;background-color:RGBA(0,0,0,0.15);border-radius:0 0 5px 5px;"><strong>To include in template: </strong>&lt;?php $consumer = ISI_Holder::get_isi();?&gt; <strong>or</strong> &lt;?php echo ISI_Holder::get_isi();?&gt;</div>
				</section>
				<section>
					<h2><?php _e('HCP ISI', 'fpmisi') ?></h2>
					<?php wp_editor( $hcp_isi, 'hcp_isi' ); ?>
					<div style="padding:10px;background-color:RGBA(0,0,0,0.15);border-radius:0 0 5px 5px;"><strong>To include in template: </strong>&lt;?php $hcp = ISI_Holder::get_isi('hcp');?&gt; <strong>or</strong> &lt;?php echo ISI_Holder::get_isi('hcp');?&gt;</div>
				</section>
				<?php submit_button(); ?>
			</form>
		</div>
		<?php
	}


	public static function get_isi($version='consumer'){
		$isi_copy = wpautop(get_option('consumer_isi', 'Add Important Safety Information under the settings menu'));
		if($version=='hcp'){
			$isi_copy = wpautop(get_option('hcp_isi', 'Add Important Safety Information under the settings menu'));
		}
		return $isi_copy;
	}

}