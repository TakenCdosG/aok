<?php
/**
 * Template Name: Search Results
 */
$argstart = $_POST['argstart'];

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$ccname = $_POST['ccname'];
$age = $_POST['age'];
$qsp = $_POST['qsp'];
$lang = $_POST['lang'];
$cop = $_POST['cop'];

$opeve = $_POST['opeve'];
$opweek = $_POST['opweek'];
$cfork = $_POST['cfork'];
$cam = $_POST['cam'];
// args
$args0 = array(
  'post_type' => 'child_care',
  'orderby'   => 'title',
  'order'     => 'ASC',
  'post_status' => 'any',
  'posts_per_page' => 10,
);
$args1 = array(
  'numberposts' => -1,
  'post_type'   => 'child_care',
  'meta_query'  => array(
    'relation'    => 'AND',
    array(
      'key'   => 'fname',
      'value'   => $fname,
      'compare' => '='
    ),
    array(
      'key'   => 'lname',
      'value'   => $lname,
      'compare' => '='
    ),
    array(
      'key'   => 'cc-name',
      'value'   => $ccname,
      'compare' => '='
    ),
    array(
      'key'   => 'age',
      'value'   => $age,
      'compare' => '='
    ),
    array(
      'key'   => 'qsp',
      'value'   => $qsp,
      'compare' => '='
    ),
    array(
      'key'   => 'lang',
      'value'   => $lang,
      'compare' => '='
    ),
    array(
      'key'   => 'cop',
      'value'   => $cop,
      'compare' => '='
    ),
    array(
      'key'   => 'opeve',
      'value'   => $opeve,
      'compare' => '='
    ),
    array(
      'key'   => 'opweek',
      'value'   => $opweek,
      'compare' => '='
    ),
    array(
      'key'   => 'cfork',
      'value'   => $cfork,
      'compare' => '='
    ),
    array(
      'key'   => 'cam',
      'value'   => $cam,
      'compare' => '='
    )
  )
);
$args2 = array(
  'numberposts' => -1,
  'post_type'   => 'child_care',
  'meta_query'  => array(
    'relation'    => 'OR',
    array(
      'key'   => 'fname',
      'value'   => $fname,
      'compare' => '='
    ),
    array(
      'key'   => 'lname',
      'value'   => $lname,
      'compare' => '='
    ),
    array(
      'key'   => 'cc-name',
      'value'   => $ccname,
      'compare' => '='
    ),
    array(
      'key'   => 'age',
      'value'   => $age,
      'compare' => '='
    ),
    array(
      'key'   => 'qsp',
      'value'   => $qsp,
      'compare' => '='
    ),
    array(
      'key'   => 'lang',
      'value'   => $lang,
      'compare' => '='
    ),
    array(
      'key'   => 'cop',
      'value'   => $cop,
      'compare' => '='
    ),
    array(
      'key'   => 'opeve',
      'value'   => $opeve,
      'compare' => '='
    ),
    array(
      'key'   => 'opweek',
      'value'   => $opweek,
      'compare' => '='
    ),
    array(
      'key'   => 'cfork',
      'value'   => $cfork,
      'compare' => '='
    ),
    array(
      'key'   => 'cam',
      'value'   => $cam,
      'compare' => '='
    )
  )
);
if($argstart == 1){
  $args = $args0;
}else{
  if(empty($fname) or empty($lname) or empty($ccname) or empty($age) or empty($qsp) or empty($lang) or empty($cop) or empty($opeve) or empty($opweek) or empty($cfork) or empty($cam)){
    $args = $args2;
  }else{
    $args = $args1;
  }  
}


// query
$the_query = new WP_Query( $args );
$count_results = 0;

if( $the_query->have_posts() ): ?>
  <div class="row"> 
    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
      <div class="col-lg-4">
          <div class="result-item">
            <a href="<?php the_permalink(); ?>">
              <div style="width:100%; height:250px; background-size:cover; background-position:center; background-image:url(<?php the_post_thumbnail_url('medium'); ?>);"></div>
              <div class="result-title">
                <?php the_title(); ?>
              </div> 
            </a>
            <?php
              $arg = array (
                  'echo' => true
              );
              // do_action('gd_mylist_btn',$arg);
            ?>
          </div>
      </div>
    <?php 
      $count_results++;
      endwhile;     
    ?> 
    <div class="count_results" style="display:none;">
      <?php echo $count_results; ?>
    </div>
    </div>
<?php endif; ?>

<?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>



