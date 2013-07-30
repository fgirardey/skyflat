<?php
/**
 *
 * Admin pannel for SkyFlat
 *
 * @author: Florian Girardey <florian@girardey.net>
 * @organization: Groupe Forum
 * @package: Skyflat
 * @version: 1.0
 * @date: 2013
*/


add_action( 'admin_init', 'mySocialProfiles' );

function mySocialProfiles( )
{
	register_setting( 'my-pannel', 'facebook_url' );
	register_setting( 'my-pannel', 'twitter_url' );
	register_setting( 'my-pannel', 'google_url' );
	register_setting( 'my-pannel', 'github_url' );
}

add_action( 'admin_menu', 'myThemeAdminMenu' );

function myThemeAdminMenu( )
{
	add_menu_page(
		'Options de mon thème', // le titre de la page
		'SkyFlat',            	// le nom de la page dans le menu d'admin
		'administrator',        // le rôle d'utilisateur requis pour voir cette page
		'my-pannel',        // un identifiant unique de la page
		'myThemeSettingsPage',   // le nom d'une fonction qui affichera la page
		null,
		64
	);
	add_submenu_page(
		'my-pannel',
		__('Social Networks','skyflat'),
		__('Social Networks','skyflat'),
		'administrator',
		'social-network',
		'socialNetworkPannel'
	);
}

function myThemeSettingsPage()
{
?>
	<div class="wrap">
		<h2>
			SkyFlat Theme
		</h2>
	</div>
<?php
}

function socialNetworkPannel(){
	?>
		<div class="wrap theme-options-page">
			<div id="icon-users" class="icon32"><br></div>
			<h2><?php _e( 'Social Networks', 'skyflat'); ?></h2>
			<div class="description"><?php _e( 'Your Social Networks URL', 'skyflat' ); ?></div>
			<link rel="stylesheet" type="text/css" href="<?= get_stylesheet_directory_uri(); ?>/css/entypo.css" />
			<style>
				.navSocial > li { background-color: #007eff; }
				.navSocial > li > a:before{content:'\F30A';font-family:entypo}
				ul.menuIcon{list-style:none;border-left:1px solid rgba(255,255,255,0.1);margin:0}
				ul.menuIcon li{float:left;position:relative}
				ul.menuIcon a{font-size:0;color:transparent;width:60px;height:60px;display:block;border-right:1px solid rgba(255,255,255,0.1)}
				ul.menuIcon a:hover{background:rgba(255,255,255,0.1)}
				ul.menuIcon a:before{font-family:entypo;font-size:24px;color:#fff;position:absolute;top:19px;left:22px}
				ul.menuIcon .twitter a:before{content:'\f309';left:20px}
				ul.menuIcon .facebook a:before{content:'\f30c'}
				ul.menuIcon .google a:before{content:'\f30f'}
				ul.menuIcon .github a:before{content:'\f300'}
			</style>
			<div class="apercu">
				<table class="form-table">
					<tr valign="top">
						<th><?php _e('Preview') ?> :</th>
						<td>
							<ul id="sortable" class="menuIcon pull-right navSocial">
								<li class="twitter"><a href="<?= get_option('twitter_url', '#'); ?>">twitter</a></li>
								<li class="facebook"><a href="<?= get_option('facebook_url', '#'); ?>">facebook</a></li>
								<li class="google"><a href="<?= get_option('google_url', '#'); ?>" rel="author">google+</a></li>
								<li class="github"><a href="<?= get_option('github_url', '#'); ?>" rel="author">github</a></li>
							</ul>
						</td>
					</tr>
				</table>
			</div>
			<form method="post" action="options.php">
				<?php
					// cette fonction ajoute plusieurs champs cachés au formulaire
					// pour vous faciliter le travail.
					// elle prend en paramètre le nom du groupe d'options
					// que nous avons défini plus haut.

					settings_fields( 'my-pannel' );
				?>
				<div class="theme-options-group">
					<table cellspacing="0" class="widefat form-table">
						<thead>
							<tr>
								<th colspan="2"><?php _e('My Social Networks', 'skyflat') ?></th>
							</tr>
						</thead>
						<tbody>
							<tr valign="top">
								<th scope="row">
									<label for="twitter_url" title="Twitter">Twitter</label>
								</th>
								<td>
									<input type="text" id="twitter_url" name="twitter_url" value="<?php echo get_option( 'twitter_url' ); ?>" size="75" />
								</td>
							</tr>

							<tr valign="top">
								<th scope="row">
									<label for="facebook_url" title="Facebook">Facebook</label>
								</th>
								<td>
									<input type="text" id="facebook_url" name="facebook_url" value="<?php echo get_option( 'facebook_url' ); ?>" size="75" />
								</td>
							</tr>

							<tr valign="top">
								<th scope="row">
									<label for="google_url" title="Google +">Google +</label>
								</th>
								<td>
									<input type="text" id="google_url" name="google_url" value="<?php echo get_option( 'google_url' ); ?>" size="75" />
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">
									<label for="github_url" title="Github">Github</label>
								</th>
								<td>
									<input type="text" id="github_url" name="github_url" value="<?php echo get_option( 'github_url' ); ?>" size="75" />
								</td>
							</tr>
						</tbody>
					</table>
					<p class="submit">
						<input type="submit" name="pannel_update" class="button-primary autowidth" value="<?php _e('Update'); ?>" />
					</p>
				</div>
			</form>
		</div>
	<?php
}

?>