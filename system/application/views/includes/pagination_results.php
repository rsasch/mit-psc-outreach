		<div class="searchinfo">
			<p class="totals">Result <?=$start + 1?> - <?php if (($start + $per_page) < $total_rows) print $start + $per_page; else print $total_rows ?> of <?=$total_rows?></p>
			<fieldset class="pagination">
			<?php if($prevlink): ?>
			<a href="<?=base_url()?>home/search/<?=$prevlink?>">&lt; Prev</a>
			<?php endif; ?>
			<?php if ($total_pages > 1): ?>
				<?php for($i = 1; $i <= $total_pages; $i++): ?>
					<input type="submit" name="page" value="<?=$i?>"<?php if ($i == $this_page) echo " class=\"selected\""; ?> />
				<?php endfor; ?>
			<?php endif; ?>
			<?php if($nextlink): ?>
			<a href="<?=base_url()?>home/search/<?=$nextlink?>">Next &gt;</a>
			<?php endif; ?>
			</fieldset>
		</div>
		