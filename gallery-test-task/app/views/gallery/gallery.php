<p><b>Теги:</b> 
<?php if(is_array($tags) && count($tags) > 0):
		foreach($tags as $tag): ?>
		<a href="/index.php?tag=<?=$tag["tag_name"]?>">#<?=$tag["tag_name"]?></a> 
			<!-- Здесь вывод тегов -->  
<?php 		endforeach;
	endif;?>
</p>
<hr>
<?php if(isset($tag_name) && $tag_name != ""):?>
<h2><?=$tag_name?></h2>
<?php endif;?>
<div class="gallery">
	<?php if(is_array($items) && count($items) > 0):
		foreach($items as $item): ?>
			<div class="image-gallery">
				<a href="<?=$item['path']?>"  onclick="OpenWindow(this.href); return false"><img src="<?=$item['path_mini']?>" alt=""></a>
				<span><?=$item['filename']?></span>
			</div>
	<?php 		endforeach;
		endif;?>
	<div class="clear"></div>
</div>
<script type="text/javascript">
function OpenWindow (Address) {
  MyWindow = window.open(Address, "Auto", "width=400,height=300,left=100,top=200");
  MyWindow.focus();
}
</script>
