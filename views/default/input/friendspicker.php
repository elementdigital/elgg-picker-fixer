<?php
/**
 * Elgg friends picker
 * Lists the friends picker
 *
 * @warning Below is the ugliest code in Elgg. It needs to be rewritten or removed
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['entities'] The array of ElggUser objects
 * @uses $vars['name']
 * @uses $vars['value']
 * @uses $vars['highlight']
 * @uses $vars['callback']
 */

elgg_load_js('elgg.friendspicker');
elgg_load_js('jquery.easing');


$chararray = elgg_echo('friendspicker:chararray');

// Initialise name
if (!isset($vars['name'])) {
	$name = "friend";
} else {
	$name = $vars['name'];
}

// Are we highlighting default or all?
if (empty($vars['highlight'])) {
	$vars['highlight'] = 'default';
}
if ($vars['highlight'] != 'all') {
	$vars['highlight'] = 'default';
}

// Initialise values
if (!isset($vars['value'])) {
	$vars['value'] = array();
} else {
	if (!is_array($vars['value'])) {
		$vars['value'] = (int) $vars['value'];
		$vars['value'] = array($vars['value']);
	}
}

// Initialise whether we're calling back or not
if (isset($vars['callback'])) {
	$callback = $vars['callback'];
} else {
	$callback = false;
}

// We need to count the number of friends pickers on the page.
if (!isset($vars['friendspicker'])) {
	global $friendspicker;
	if (!isset($friendspicker)) {
		$friendspicker = 0;
	}
	$friendspicker++;
} else {
	$friendspicker = $vars['friendspicker'];
}

$users = array();
$activeletters = array();

// Are we displaying form tags and submit buttons?
// (If we've been given a target, then yes! Otherwise, no.)
if (isset($vars['formtarget'])) {
	$formtarget = $vars['formtarget'];
} else {
	$formtarget = false;
}

// Sort users by letter
if (is_array($vars['entities']) && sizeof($vars['entities'])) {
	foreach($vars['entities'] as $user) {
		$letter = elgg_strtoupper(elgg_substr($user->name, 0, 1));

		if (!elgg_substr_count($chararray, $letter)) {
			$letter = "*";
		}
		if (!isset($users[$letter])) {
			$users[$letter] = array();
		}
		$users[$letter][$user->guid] = $user;
	}
}

// sort users in letters alphabetically
foreach ($users as $letter => $letter_users) {
	usort($letter_users, function($a, $b) {
		return strcasecmp($a->name, $b->name);
	});
	$users[$letter] = $letter_users;
}

if (!$callback) {
	?>

	<div class="friends-picker-main-wrapper">

	<?php

	if (isset($vars['content'])) {
		echo $vars['content'];
	}
	?>

	<div id="friends-picker_placeholder<?php echo $friendspicker; ?>">

	<?php
}

if(!isset($vars['replacement'])) {
	if($formtarget) {
		?>
		<script>
		require(['elgg', 'jquery'], function(elgg, $) {
			$(function () {
				$('#collectionMembersForm<?php echo $friendspicker; ?>').submit(function() {
					var inputs = [];
					$(':input', this).each(function() {
						if (this.type != 'checkbox' || (this.type == 'checkbox' && this.checked != false)) {
							inputs.push(this.name + '=' + escape(this.value));
						}
					});
					$.ajax({
						type: "POST",
						data: inputs.join('&'),
						url: this.action,
						success: function(){
							$('a.collectionmembers<?php echo $friendspicker; ?>').click();
						}

					});
					return false;
				});
			});
		});
		</script>
		<?php
		//Collection members form
		echo "<form id=\"collectionMembersForm".$friendspicker."\" action=\"".$formtarget."\" method=\"post\">";
	
		echo elgg_view('input/securitytoken');
		echo elgg_view('input/hidden', array(
			'name' => 'collection_id',
			'value' => $vars['collection_id'],
		));
	}//end if ($formtarget)

	echo "<div class=\"friends-picker-wrapper\">";
		echo "<div id=\"friends-picker".$friendspicker."\">";
			echo "<div class=\"friends-picker-container\">";

			// Initialise letters
			$chararray .= "*";
			$letter = elgg_substr($chararray, 0, 1);
			$letpos = 0;
			while (1 == 1) {
				echo "<div class=\"panel\" title=\"".$letter."\">";
					echo "<div class=\"wrapper\">";
					echo "<h3>".$letter."</h3>";
					if (isset($users[$letter])) {
						ksort($users[$letter]);
						echo "<div class=\"friendslist\">";
						foreach($users[$letter] as $friend) {

							$label = elgg_view_entity_icon($friend, 'tiny', array('use_hover' => false));
							$options[$label] = $friend->getGUID();

							if ($vars['highlight'] == 'all' && !in_array($letter,$activeletters)) {
								$activeletters[] = $letter;
							}

							if (in_array($friend->getGUID(),$vars['value'])) {
								$checked = "checked = \"checked\"";
								if (!in_array($letter,$activeletters) && $vars['highlight'] == 'default') {
									$activeletters[] = $letter;
								}
							} else {
								$checked = "";
							}

							echo "<div class=\"item\">";
								echo "<label for=\"".$options[$label]."-".$friendspicker."\">";
									echo "<div class=\"inner\">";
										
										echo "<div class=\"cbox\">";
											echo "<input id=\"".$options[$label]."-".$friendspicker."\" type=\"checkbox\"".$checked."\" name=\"".$name."[]\" value=\"".$options[$label]."\" />";
										echo "</div>";
										echo $label;
										
										echo "<div class=\"userinfo\">";
											
												echo "<p>";
													//echo "<label for=\"".$options[$label]."\">";
													echo $friend->name;
													//echo "</label>";
												echo "</p>";
											
										echo "</div>";
										
									echo "</div>";
								echo "</label>";
							echo "</div>";
						}
						echo "</div>";//end div friendslist
					}
					echo "</div>";
				echo "</div>";//end div pannel

				$substr = elgg_substr($chararray, elgg_strlen($chararray) - 1, 1);
				if ($letter == $substr) {
					break;
				}
				//$letter++;
				$letpos++;
				$letter = elgg_substr($chararray, $letpos, 1);
			}//end while
			echo "</div>";//end div friends-picker-container

			if ($formtarget) {
				if (isset($vars['formcontents']))
					echo $vars['formcontents'];
					echo "<div class=\"clearfix\"></div>";
					echo "<div class=\"friendspicker-savebuttons\">";
						echo "<input type=\"submit\" class=\"elgg-button elgg-button-submit\" value=\"".elgg_echo('save')."\" />";
						echo "<input type=\"button\" class=\"elgg-button elgg-button-cancel\" value=\"".elgg_echo('cancel')."\" />";
						//echo "<input type=\"button\" class=\"elgg-button elgg-button-cancel\" value=\"".elgg_echo('cancel')."\" onclick=\"\$(\'a.collectionmembers".$friendspicker."\').click()\;\" />";
					echo "</div>";
					//echo "</form>";//end form ?
				}
				echo "</div>";//end div id=\"friends-picker".$friendspicker."
				echo "</div>";//end div friends-picker-wrapper
				echo "</form>";//end form ?

			} else {
				echo $vars['replacement'];
			}

	if (!$callback) {
		echo "</div>";// end div id="friends-picker_placeholder<?php echo $friendspicker;
		echo "</div>";//ebd friends-picker-main-wrapper
		
	}

	if (isset($vars['replacement'])) {
		return;
	}

?>
<script>
require(['jquery'], function($) {
	$(function () {
		// initialise picker
		$("div#friends-picker<?php echo $friendspicker; ?>").friendsPicker(<?php echo $friendspicker; ?>);

		<?php
		// manually add class to corresponding tab for panels that have content
		if (sizeof($activeletters) > 0) {
			//$chararray = elgg_echo('friendspicker:chararray');
			foreach($activeletters as $letter) {
				$tab = elgg_strpos($chararray, $letter) + 1;
			?>
		$("div#friends-picker-navigation<?php echo $friendspicker; ?> li.tab<?php echo $tab; ?> a").addClass("tabHasContent");
		<?php
			}
		}
		?>
	});
});
</script>
