<?php
/**
 * Elgg friends picker
 * Lists the friends picker
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['entities'] The array of ElggUser objects
 */

if (is_array($vars['entities'])) {
	echo "<div class=\"collectionlist\">";
	foreach($vars['entities'] as $entity) {
		if (!($entity instanceof ElggEntity)) {
			$entity = get_entity($entity);
		}
		if ($entity instanceof ElggEntity) {
			echo "<div class=\"item\">";
				echo "<div class=\"inner\">";
					echo elgg_view_entity_icon($entity, 'tiny');
			
					echo "<div class=\"userinfo\">";
						echo "<p>".$entity->name."</p>";
					echo "</div>";
				echo "</div>";
			echo "</div>";
		}
	}
	echo "</div>";
}

if (isset($vars['content'])) {
	echo $vars['content'];
}
?>

