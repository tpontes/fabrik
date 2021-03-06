<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Fabrik.visualization.calendar
 * @copyright   Copyright (C) 2005 Fabrik. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

 if ($this->showFilters) :?>
<form method="post" name="filter" action="">
<?php
	foreach ($this->filters as $table => $filters) :
		if (!empty($filters)) :
		?>
	  <table class="filtertable table table-striped"><tbody>
	  <tr>
		<th style="text-align:left"><?php echo JText::_('PLG_VISUALIZATION_CALENDAR_SEARCH'); ?>:</th>
		<th style="text-align:right"><a href="#" class="clearFilters"><i class="icon-refresh"></i> <?php echo JText::_('PLG_VISUALIZATION_CALENDAR_CLEAR'); ?></a></th>
	</tr>
	  <?php
			$c = 0;
			foreach ($filters as $filter) :
		 	?>
	    <tr class="fabrik_row oddRow<?php echo ($c % 2); ?>">
	    	<td><?php echo $filter->label ?> </td>
	    	<td><?php echo $filter->element ?></td>
	  <?php
				$c++;
			endforeach;
		?>
	  </tbody>
	  <thead><tr><th colspan='2'><?php echo $table ?></th></tr></thead>
	  <tfoot><tr><th colspan='2' style="text-align:right;">
	  <button type="submit" class="btn btn-info">
	  	<i class="icon-filter"></i> <?php echo JText::_('PLG_VISUALIZATION_CALENDAR_GO') ?>
	  </button>
	  </th></tr></tfoot></table>
	  <?php
		endif;
	endforeach;
?>
<input type="hidden" name="resetfilters" value="0" />
</form>
<?php
endif;
