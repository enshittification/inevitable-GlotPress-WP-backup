<?php
gp_title( __( 'Profile &lt; GlotPress', 'glotpress' ) );
gp_breadcrumb( array( __( 'Profile', 'glotpress' ) ) );

gp_tmpl_header();
?>

<h2><?php echo $user->display_name; ?> <?php if ( $user->admin() ) { _e( '(Admin)', 'glotpress' ); }; ?></h2>

<div>
	<div class="user-card">
		<div class="user-avatar"><?php echo get_avatar( $user->user_email, 100 ); ?></div>

		<dl class="user-info">
			<dd><?php
				$locale_keys = array_keys( $locales );

				if ( 1 < count( $locales ) ) {
					vprintf( __( '%s is a polyglot who knows %s but also knows %s.', 'glotpress' ), array_merge( array( $user->display_name ), $locale_keys ) );
				} else if( ! empty ( $locale_keys ) ) {
					printf( __( '%s is a polyglot who contributes to %s', 'glotpress' ), $user->display_name, $locale_keys[0] );
				}
			?></dd>
			<dt><?php _e( 'Member Since', 'glotpress' ); ?></dt>
			<dd><?php echo date( 'M j, Y', strtotime( $user->user_registered ) ); ?></dd>
		</dl>
	</div>
</div>

<div id="profile">
	<div class="recent-projects">
		<h3><?php _e( 'Recent Projects', 'glotpress' ); ?></h3>

		<ul>
		<?php foreach ( $recent_projects as $project ): ?>
			<li>
				<p><?php
					echo gp_link_get( $project->project_url, $project->set_name ) . ': ';
					echo gp_link_get( $project->project_url . '?filters[status]=either&filters[user_login]=' . $user->user_login,
						sprintf( _n( '%s contribution', '%s contributions',$project->count, 'glotpress' ), $project->count ) );
				?></p>
				<p class="ago">
					<?php printf( __( 'last translation about %s ago (UTC)', 'glotpress' ), human_time_diff( gp_gmt_strtotime( $project->last_updated ) ) ); ?>
				</p>
			</li>
		<?php endforeach; ?>
		</ul>
	</div>
	<div class="validates-projects">
		<h3><?php _e( 'Validator to', 'glotpress' ); ?></h3>

		<?php if ( count($permissions) >= 1 ): ?>
			<ul>
			<?php foreach ( $permissions as $permission ): ?>
				<li>
					<p> <?php echo gp_link_get( $permission->project_url, $permission->set_name ); ?> </p>
				</li>
			<?php endforeach; ?>
			</ul>
		<?php else: ?>
			<p><?php printf( __( '%s is not validating any projects!', 'glotpress' ), $user->display_name )?></p>
		<?php endif ?>
	</div>
</div>

<?php gp_tmpl_footer();
