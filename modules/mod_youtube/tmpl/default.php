<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<?php if ($y_id) { ?>

	<div class="youtube-video" data-width="<?php echo $width; ?>" data-height="<?php echo $height; ?>">
		<iframe id="video-<?php echo $uniqid ?>" src="http://www.youtube.com/embed/<?php echo $y_id ?>?wmode=transparent&origin=<?php echo $origin ?>&showinfo=0" width="<?php echo $width; ?>" height="<?php echo $height; ?>" frameborder="0" allowfullscreen></iframe>
        <div class="title-video" style="height: 40px">
            <?php if ($y_title){ ?>
            <span style="display: block; text-align: center;" ><?php echo $y_title ?></span>
            <?php } ?>
        </div>
	</div>

<?php } else { ?>
	<p>Please enter youtube id.</p>
<?php } ?>