<?php
if (!defined('ABSPATH')) exit;

$args = [
    'post_type' => ['anime', 'movie'],
    'posts_per_page' => 20,
];
$query = new WP_Query($args);
?>

<div class="aniwp-container">
    <h2 class="aniwp-title">AniWP Collection</h2>
    <div class="aniwp-grid">
        <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
            <?php
            $cover_image = get_post_meta(get_the_ID(), '_anilist_cover_image', true);
            $title = get_post_meta(get_the_ID(), '_anilist_title_romaji', true) ?: get_the_title();
            $score = get_post_meta(get_the_ID(), '_anilist_score', true);
            $episodes = get_post_meta(get_the_ID(), '_anilist_episodes', true);
            ?>
            <div class="aniwp-card">
                <a href="<?php the_permalink(); ?>" class="aniwp-link">
                    <div class="aniwp-image" style="background-image: url('<?php echo esc_url($cover_image); ?>');"></div>
                    <div class="aniwp-content">
                        <h3 class="aniwp-anime-title"><?php echo esc_html($title); ?></h3>
                        <p class="aniwp-score">Score: <?php echo esc_html($score); ?>/100</p>
                        <p class="aniwp-episodes">Episodes: <?php echo esc_html($episodes); ?></p>
                    </div>
                </a>
            </div>
        <?php endwhile; wp_reset_postdata(); else : ?>
            <p>No anime or movie found.</p>
        <?php endif; ?>
    </div>
</div>
