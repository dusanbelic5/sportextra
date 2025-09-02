<?php
/**
 * Social Icons Template
 */

$class_name = 'social_icons_block';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}

// Fields
$heading         = get_field('heading');
?>
<div class="<?php echo esc_attr( $class_name ); ?> <?php echo preg_replace('/\W+/','',strtolower(strip_tags($heading))) ?> se-block">
    <div class="se-container">

    </div>
</div>
