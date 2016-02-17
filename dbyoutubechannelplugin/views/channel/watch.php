<?php if (!function_exists('add_action')) exit(); ?>
<?php echo $_header; ?>

<section class="sermon-plugin" id="watch-sermon">

    <div class="embed-responsive embed-responsive-16by9">
        <iframe width="420" height="315" src="https://www.youtube.com/embed/<?php echo $video['id']; ?>?rel=0&autoplay=1" frameborder="0" allowfullscreen></iframe>
    </div>


    <div class="row" style="margin-top:10px; min-height: 500px;">
        <div class="col-md-12">
            <div class="small" style="margin:0px 0px 5px 5px;">
                <i class="fa fa-clock-o"></i>
                <?php echo date_i18n(get_option('date_format'), strtotime($video['snippet']['publishedAt'])); ?>
            </div>
            <h3><?php echo $video['snippet']['title']; ?></h3>


            <div>
                <a target="_blank" class="btn btn-sm btn-default" href="http://twitter.com/home/?status=I'd love to share a video with you: <?php echo $activeSermon->title; ?> <?php echo (strpos(the_permalink(), '?') === false ? "?" : "&") . "v={$video['id']}&t={$video['snippet']['title']}"; ?>">
                    <i class="fa fa-twitter fa-fw"></i>
                </a>

                <a target="_blank" class="btn btn-sm btn-default" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo (strpos(the_permalink(), '?') === false ? "?" : "&") . "v={$video['id']}&t={$video['snippet']['title']}"; ?>">
                    <i class="fa fa-facebook fa-fw"></i>
                </a>

                <a target="_blank" class="btn btn-sm btn-default" href="https://www.youtube.com/watch?v=<?php echo $video['id']; ?>">
                    <i class="fa fa-youtube fa-fw"></i>
                </a>

            </div>

            <div style="margin-top:10px;">
                <small><?php echo $video['snippet']['description']; ?></small>
            </div>



        </div>

    </div>
</section>


