<?php
get_header();
while ( have_posts() ) :
    the_post();
    $post = get_post();
    $status = get_field('species', $post->ID);
    $core_values = get_field('core_values', $post->ID);
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-4 mb-5 mb-lg-0 wow fadeIn">
            <div class="card border-0 shadow">
                <img src="<?= wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'thumbnail'); ?>">
                <div class="card-body p-1-9 p-xl-5">
                    <div class="mb-4">
                        <h3 class="h4 mb-0"><?php the_title(); ?></h3>
                        <span class="text-primary"><?= esc_html($status); ?></span>
                    </div>
                    <?php
                    $skills = get_the_terms(get_the_ID(), 'skills');
                    if ($skills && !is_wp_error($skills)) :
                    ?>
                        <h4 class="h5 mb-3">Skills</h4>
                        <ul class="list-unstyled mb-4 ms-0">
                            <?php foreach ($skills as $skill) : ?>
                                <li class="mb-2"><a href="#!"><i class="fas fa-check-circle display-25 me-3 text-secondary"></i><?= esc_html($skill->name); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="ps-lg-1-6 ps-xl-5">
                <div class="mb-5 wow fadeIn">
                    <div class="text-start mb-1-6 wow fadeIn">
                        <h2 class="h1 mb-0 text-primary">#About Me</h2>
                    </div>
                    <?php the_content(); ?>
                </div>
                <div class="mb-5 wow fadeIn">
                    <div class="text-start mb-1-6 wow fadeIn">
                        <h2 class="mb-0 text-primary">#Core Values</h2>
                    </div>
                    <div class="mt-n4">
                        <?php 
                        if ( $core_values && ! is_wp_error( $core_values ) ) :
                            foreach ( $core_values as $value_id ) :
                                $value = get_post($value_id);
                                if ( is_a( $value, 'WP_Post' ) ) :
                        ?>
                                <div class="col-sm-6 col-xl-4">
                                    <div class="card border-0">
                                            <h3 class="h5 mb-3">-  <?= esc_html($value->post_title); ?></h3>
                                    </div>
                                </div>
                        <?php 
                                endif;
                            endforeach;
                        else :
                            echo '<p>No core values found.</p>';
                        endif; 
                        ?>
                    </div>
                </div>
                <div class="wow fadeIn">
                    <div class="text-start mb-1-6 wow fadeIn">
                        <h2 class="mb-0 text-primary">#Experience</h2>
                    </div>
                    <?php
                    $experience = get_the_terms(get_the_ID(), 'experience');
                    if ($experience && !is_wp_error($experience)) :
                    ?>
                            <?php foreach ($experience as $exp) : ?>
                                <h3 class="h5 mb-3">-  <?= esc_html($exp->name); ?></h3>
                            <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
endwhile; // End of the loop.
get_footer();
?>
