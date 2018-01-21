<?php
defined('_JEXEC') or die('Restricted access');
?>
<?php if ($y_id) { ?>

    <div class="youtube-video" data-width="<?php echo $width; ?>" data-height="<?php echo $height; ?>">
        <iframe id="video-<?php echo $uniqid ?>"
                src="http://www.youtube.com/embed/<?php echo $y_id ?>?wmode=transparent&origin=<?php echo $origin ?>&showinfo=0"
                width="<?php echo $width; ?>" height="<?php echo $height; ?>" frameborder="0" allowfullscreen></iframe>
        <?php if ($y_title) { ?>
            <div class="title-video" style="width: <?php echo $width; ?>px;">
                <span style="display: block;"><?php echo $y_title ?></span>
            </div>
        <?php } ?>
    </div>

<?php } else { ?>
    <p>Please enter youtube id.</p>
<?php } ?>