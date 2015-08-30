<?php get_header(); ?>
  <?php while ( have_posts() ) : the_post(); ?>
    <?php if ( ! post_password_required() ) :?>
      <main class="region content">
        <div class="wrapper">
          <div>
          <section>
            <?php if ($mask->partial_exist($pagename)): ?>
              <?php $mask->get_partial($pagename); ?>
            <?php else: ?>
              <h2><?php the_title(); ?></h2>
              <div class="editor">
                <?php the_content(); ?>
              </div>
            <?php endif; ?>
          </section>
          </div>
        </div>
      </main>
    <?php else: ?>
      <main class="region content">
        <div class="wrapper">
          <div>
          <section>
          <form class="password-protected" action="<?php bloginfo('url'); ?>/wp-login.php?action=postpass" method="post">
            <p>This page is password protected. Please enter your password below:</p>
            <p><input name="post_password" id="" type="password" size="20" /><input type="submit" name="Submit" value="Submit" /></p>
          </form>
          </section>
          </div>
        </div>
      </main>
    <?php endif; ?>
  <?php endwhile; ?>
  <?php get_sidebar(); ?>
<?php get_footer(); ?>