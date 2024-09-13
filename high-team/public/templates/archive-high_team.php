<?php
/****
 *
 * Category Template
 *
 ****/
?>


<?php get_header(); ?>


<main class="high-team">


	<div class="team-container">
		<?php echo '<h1 class="cat-title"> Our Team </h1>'; ?>
		<div class="team-row">

			<?php

			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$args = array(
				'posts_per_page' => 5,
				'post_type' => 'high_team',
				'paged' => $paged,
			);

			$high_query = new WP_Query($args);

			if ($high_query->have_posts()):
				while ($high_query->have_posts()):
					$high_query->the_post();

					$roles = get_the_terms($post->ID, 'high_role');

					foreach ($roles as $role) {
						$role_name = $role->name;
					}

					?>

					<article class=" high-team-flex">

						<div class="team-content">

							<header class="high-member-head">
								<h2 class="member-name"><a href="<?php the_permalink() ?>" rel="bookmark"
										title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

								<span class="member-meta high-team-role"><?php echo $role_name; ?> </span>
							</header>

							<figure class="team-member-thumb"><a href="<?php the_permalink() ?>" rel="bookmark"
									title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?>
								</a>
							</figure>

						</div>
						<div class="team-excerpt-content">
							<div class="high-team-member">
								<?php the_excerpt(); ?>
							</div>
						</div>

						<footer class="high-member-foot">

							<?php

							$high_team_email = esc_html(get_post_meta(get_the_ID(), 'high_team_email', true));
							$high_team_face = esc_html(get_post_meta(get_the_ID(), 'high_team_face', true));
							$high_team_twit = esc_html(get_post_meta(get_the_ID(), 'high_team_twit', true));
							$high_team_link = esc_html(get_post_meta(get_the_ID(), 'high_team_link', true));
							$high_team_insta = esc_html(get_post_meta(get_the_ID(), 'high_team_insta', true));

							if (!empty($high_team_email)) {

								echo '<a class="" href="mailto:' . $high_team_email . '" target="_blank"><span class="member-meta high-team-contact icons email"></span></a>  ';

							}
							if (!empty($high_team_face)) {

								echo '<a class=" " href="' . $high_team_face . '" target="_blank"><span class="member-meta high-team-contact icons face"></span></a>  ';

							}
							if (!empty($high_team_twit)) {

								echo '<a class="" href="' . $high_team_twit . '" target="_blank"><span class="member-meta high-team-contact icons twit"></span></a>  ';

							}
							if (!empty($high_team_link)) {
								echo '<a class="" href="' . $high_team_link . '" target="_blank"><span class="member-meta high-team-contact icons link"></span></a>  ';

							}
							if (!empty($high_team_insta)) {

								echo '<a class=" link" href="' . $high_team_insta . '" target="_blank"><span class="member-meta high-team-contact icons insta"></span></a>  ';

							}

							?>
						</footer>
					</article>

				<?php endwhile; ?>
			<?php endif; ?>


		</div>
	</div> <!-- this is the blog -->

</main>

<?php get_footer(); ?>