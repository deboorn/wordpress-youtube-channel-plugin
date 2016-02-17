<?php if (!function_exists('add_action')) exit(); ?>

<?php echo $html; ?>

<?php echo $_header; ?>

<section class="sermon-plugin">

    <h2><?php echo get_the_title(); ?></h2>


    <form action="">
        <input class="col-md-12 col-sm-12 col-xs-12 col-lg-12" type="text" placeholder="Search for a Video" id="form_q"
               name="q" style="margin-bottom: 20px;"
               value="<?php echo YoutubeChannelPlugin_Input::param('q'); ?>"
            />
    </form>

    <div class="row series-list">
        <?php $count = -1; ?>
        <?php foreach((array)$result['items'] as $item): $count++; ?>
            <div class="<?php echo $attributes['columns']; ?>" style="<?php echo $attributes['break'] && $count%3 == 0 ? "" : ""; ?>">
                <a class="img-thumbnail" href="<?php echo $attributes['videopageurl'] . (strpos($attributes['videopageurl'], '?') === false ? "?v=" : "&v=") . $item['id']['videoId'] . '&t=' . $item['snippet']['title']; ?>">
                    <img src="<?php echo $item['snippet']['thumbnails']['high']['url']; ?>" style="width:100%; height:auto;">
                    <p><?php echo $item['snippet']['title']; ?></p>
                </a>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if(count((array)$result['items']) == 0): ?>
        <?php if(YoutubeChannelPlugin_Input::param('q')): ?>
            <p>Sorry no matching videos found.</p>
        <?php else: ?>
            <p>Sorry nothing to watch yet. Please add a video to the channel.</p>
        <?php endif; ?>
    <?php endif; ?>

    <small style="color: #757575; margin-top:10px;">
        <?php if($previousPage): ?>
            <a class="btn btn-large btn-default" href="<?php echo $previousPage; ?>"><i class="fa fa-chevron-left"></i> Back</a>
        <?php endif; ?>
        <?php if($nextPage): ?>
            <a class="btn btn-large btn-default" href="<?php echo $nextPage; ?>">Next <i class="fa fa-chevron-right"></i></a>
        <?php endif; ?>

        Found <?php echo (int)$result['pageInfo']['totalResults']; ?> video<?php echo (int)$result['pageInfo']['totalResults'] > 1 ? "s" : ""; ?>. Showing <?php echo (int)$result['pageInfo']['resultsPerPage']; ?> video per page.
    </small>



</section>

