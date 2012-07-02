		<?php if($context == "search"): ?>
		<p class="back"><a href="<?=base_url()?>home/search">back to results</a></p>
		<?php endif; ?>
		<div class="print"><p><a href="javascript:print()">Print Page</a></p></div>
		<?php if($prevlink || $nextlink): ?>
		<p class="pagination">
			<span class="inner">
				<?php if($prevlink): ?>
				<a href="<?=base_url()?>program/view/<?=$prevlink?>/search">&lt; Prev</a>
				<?php endif; ?>
	
				<?php if($nextlink): ?>
				<a href="<?=base_url()?>program/view/<?=$nextlink?>/search">Next &gt;</a>
				<?php endif; ?>
			</span>
		</p>
		<?php endif; ?>