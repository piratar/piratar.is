<h3>Veljið ár til að skoða bókhald Pírata:</h3>
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
    echo '<h4>' . $term->name . '</h4>';

  // if term has more than 0 entries
  elseif( $term->count > 0 )
    // display link to the term archive
    echo '<h4><a href="'. get_term_link( $term ) .'">'. $term->name .'</a></h4>';

}
?>