<?php
/***
 *
 *
 * Single template for High Team
 *
 *
 ***/


get_header();

$roles = get_the_terms(get_the_ID(), 'high_role');
$high_team_email = get_post_meta(get_the_ID(), 'high_team_email', true);
$high_team_face = get_post_meta(get_the_ID(), 'high_team_face', true);
$high_team_twit = get_post_meta(get_the_ID(), 'high_team_twit', true);
$high_team_link = get_post_meta(get_the_ID(), 'high_team_link', true);
$high_team_insta = get_post_meta(get_the_ID(), 'high_team_insta', true);

foreach ($roles as $role) {
	$role_name = $role->name;
}

?>
<main class="high-team single-team-member">
	<div class="container single-team-container">
		<div class="single-team-row">
			<article class="single-team">
				<header class="team-header">
					<h1 class="team-member-title"><?php the_title(); ?></h1>
					<span class="member-meta high-team-role"><?php echo $role_name; ?> </span>
					<span class="member-meta high-team-share">

						<?php
						if (!empty($high_team_email)) {

							echo '<a class="" href="mailto:' . $high_team_email . '" target="_blank"><span class="member-meta high-team-contact icons email"></span></a>  ';

						}
						if (!empty($high_team_face)) {

							echo '<a class=" " href="' . $high_team_face . '" target="_blank"><span class="member-meta high-team-contact icons face"></span></a>  ';

						}
						if (!empty($high_team_twit)) {

							echo '<a class="" href="' . $high_team_twit . '" target="_blank"><span class="member-meta high-team-contact icons twit"></span></a>  ';

						}
						if (!empty($high_team_email)) {
							echo '<a class="" href="' . $high_team_link . '" target="_blank"><span class="member-meta high-team-contact icons link"></span></a>  ';

						}
						if (!empty($high_team_email)) {

							echo '<a class=" link" href="' . $high_team_insta . '" target="_blank"><span class="member-meta high-team-contact icons insta"></span></a>  ';

						}
						?>
					</span>
				</header>
				<div class="team-member-content">
					<figure class="team-member-thumb"><?php the_post_thumbnail(array(320, 999)); ?></figure>

					<div class="team-member"><?php the_content(); ?> </div>
				</div>

			</article>

		</div>
		<nav class="high-member-nav">
			<div class="high-member-link high-member-prev"><?php next_post_link('%link', '<< %title'); ?></div>
			<div class="high-member-link high-member-next"><?php previous_post_link('%link', '%title >>'); ?></div>
		</nav>
	</div>
</main>
<?php get_footer(); ?>