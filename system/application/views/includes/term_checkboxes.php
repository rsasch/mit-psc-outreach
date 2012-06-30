<div class="container">
<?php $counter = 1; ?>
<?php foreach ($checkboxes as $category => $terms): ?>
	<?php if ($terms): ?>
	<div class="category<?php if ($counter % 2 == 0) echo " last"?>">
		<h3><?=$category?> <span class="aside">(select all that apply)</span></h3>
		<fieldset>
			<?php foreach ($terms as $term): ?>
			<div class="container required">
				<input type="checkbox" name="terms[]" value="<?=$term->term_id?>" id="term<?=$term->term_id?>" <?php if (isset($term_ids) && in_array($term->term_id, $term_ids)) print 'checked="checked"'; ?>/>
				<label for="term<?=$term->term_id?>"><?=$term->term_name?></label>
			</div>
			<?php endforeach; ?>
		</fieldset>
	</div>
	<?php if ($counter % 2 == 0): ?>
	<div class="clear">&nbsp;</div>
	<?php endif; ?>
	<?php $counter++; ?>
	<?php endif; ?>
<?php endforeach; ?>
</div>
