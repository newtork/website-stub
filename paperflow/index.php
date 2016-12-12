<?php
/**
 * The main template file.
 *
 * @package paperflow
 * @author Alexander Dümont
 * @author Takuma Misumi
 * @link TODOME
 * @license GPLv2 or later
 */

get_header(); 

if(have_posts()) {


	// get all the categories from the database
	$cats = get_categories( array(
		'hide_empty'	=> true,
		'parent'		=> get_cat_ID('paperflow'),
		'order'			=> 'ASC',
		'oderby'		=> 'slug',
	)); 

	$catCounter=0;
	
	// loop through the categries
	foreach ($cats as $cat) {
		$catCounter++;
?>

	<div class="f-page">
		<div class="f-title">
			<h2><?php echo $cat->description;?></h2>
		</div>
		<div class="box wh-page"></div>
			
<?php
		// query posts from sub category
		query_posts(array(
				'cat'				=> $cat->term_id,
				'order'				=> 'ASC',
				'meta_key'			=> 'paperflow_post_priority',
				'orderby'			=> 'meta_value_num', //or 'meta_value_num'
				'posts_per_page'	=> 100,
			)
		);
			
		// start the wordpress loop!
		if (have_posts()) {
			while (have_posts()) {
				the_post();
				get_template_part( 'template-parts/content', get_post_format() ); 
			}
		}
?>
		<a class="bookmark" href="#/?page=<?php echo $catCounter;?>"><?php echo $cat->name;?></a>
	</div>
<?php
	} // done the foreach category statement 
			

	the_posts_navigation();
}

//get_sidebar();
get_footer();
