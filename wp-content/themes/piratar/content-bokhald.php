<h3>Bókhald Pírata</h3>

<ul>
<?php 

// your taxonomy name
$tax = 'bokhalds_ar';

// get the terms of taxonomy
$terms = get_terms( $tax, [
  'hide_empty' => false, // do not hide empty terms
]);

// loop through all terms
foreach( $terms as $term ) {

  // if no entries attached to the term
  if( 0 == $term->count )
    // display only the term name
    echo '<li>' . $term->name . '</li>';

  // if term has more than 0 entries
  elseif( $term->count > 0 )
    // display link to the term archive
    echo '<li><a href="'. get_term_link( $term ) .'">'. $term->name .'</a></li>';

}
?>
</ul>