<?php get_header(); ?>
<main class="region content">
  <div class="wrapper">
    <div>
    <section>
    <?php if ( ! post_password_required() ) :?>
      <h2><?php echo $mask->pluralize($taxonomy); ?></h2>
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php if ($mask->partial_exist($taxonomy)): ?>
          <?php $mask->get_partial($taxonomy); ?>
        <?php else: ?>
          <h3><?php the_title(); ?></h3>
          <?php the_content(); ?>
        <?php endif ?>
      <?php endwhile; endif; ?>
    <?php else: ?>
    <form class="password-protected" action="<?php bloginfo('url'); ?>/wp-login.php?action=postpass" method="post">
      <p>This page is password protected. Please enter your password below:</p>
      <p><input name="post_password" id="" type="password" size="20" /><input type="submit" name="Submit" value="Submit" /></p>
    </form>
    <?php endif; ?>
    </section>
    </div>
  </div>
</main>
  <?php get_sidebar(); ?>

<?php get_footer(); ?>