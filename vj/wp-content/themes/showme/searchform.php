<?php
/**
 * Template for displaying search forms
 *
 * @package showme
 */

?>

<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <div class="input-group">
    <input type="search" id="<?php echo $unique_id; ?>" class="search-field form-control" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'showme' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
    <span class="input-group-btn">
      <button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
    </span>
  </div>
</form>
