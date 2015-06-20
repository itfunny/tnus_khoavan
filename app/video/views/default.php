<link href="<?= AppObject::getBaseFile('app/video/css/video.css') ?>"   rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?= AppObject::getBaseFile('app/video/js/jquery-ui.min.js'); ?>"></script>
<div class="content">
    <div class="col_1">
        <h2 class="page_title">MEDIA</h2>
        <div class="media_content">
            <p class="views">Lượt xem: <?= $this->lastest_video['views'] ?></p>
            <p class="media_details">
                <iframe width="630" height="415" src="https://www.youtube.com/embed/<?= $this->lastest_video["code"] ?>" frameborder="0" allowfullscreen></iframe>
            </p>
            <h2 class="media_title"><?= $this->lastest_video["title"] ?></h2>
            <p class="media_intro"><?= $this->lastest_video["introtext"] ?></p>
            <p class="author"><?= $this->lastest_video["author"] ?></p>
        </div>
        <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>
        <div class="ui-tabs">
            <ul class="ui-tabs-nav">
                <li><a href="#tabs-1">Mới nhất</a></li>
                <li><a href="#tabs-2">Xem nhiều nhất</a></li>
            </ul>
            <div id="tabs-1" class="ui-tabs-panel media_list">
                <ul class="list">
                    <?php
                    foreach ($this->most_view_video as $video) {
                        ?>
                        <li>
                            <a href="?app=video&view=chitiet&id=<?= $video['id'] ?>">
                                <img class="video_thumb" src="http://img.youtube.com/vi/<?= $video['code'] ?>/0.jpg" width="100" />
                                <p class="video_title"><?= $video['title'] ?></p>
                                <p class="views">Lượt xem: <?= $video['views'] ?></p>
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <div id="tabs-2" class="ui-tabs-panel media_list">
                <ul class="list">
                    <?php
                    foreach ($this->most_view_video as $video) {
                        ?>
                        <li>
                            <a href="#">
                                <img class="video_thumb" src="http://img.youtube.com/vi/<?= $video['code'] ?>/0.jpg" width="100" />
                                <p class="video_title"><?= $video['title'] ?></p>
                                <p class="views">Lượt xem: <?= $video['views'] ?></p>
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class="fb-comments" data-href="http://developers.facebook.com/docs/plugins/comments/" data-numposts="5" data-colorscheme="light"></div>
    </div>
    <!--/.col_1-->
    <div class="col_2">
        <div class="most_view">
            <h2 class="title"><a href="#">Xem nhiều </a></h2>
            <ul class="list">
                <?php
                foreach ($this->most_view_video as $video) {
                    ?>
                    <li>
                        <a href="?app=video&view=chitiet&id=<?= $video['id'] ?>">
                            <img class="video_thumb" src="http://img.youtube.com/vi/<?= $video['code'] ?>/0.jpg" width="100" />
                            <p class="video_title"><?= $video['title'] ?></p>
                            <p class="views">Lượt xem: <?= $video['views'] ?></p>
                        </a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <div class="event">
            <h2 class="title"><a href="#">Sự kiện </a></h2>
            <ul class="list">
                <?php
                foreach ($this->arr_event as $news) {
                    ?>
                    <li>
                        <a href="?app=tintuc&view=chitiet&id=<?= $news['id'] ?>"><?= $news["title"] ?></a>
                        <p class="date"><?= $news["date"] ?></p>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <div class="ad_left">
            <img alt="quangcao" src="media/images/ad/99f12b15-3d94-47b8-aebf-5aa1be00678d2.jpg" />
        </div>
        <!--/.col_2-->
    </div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(".ui-tabs").tabs();
    });
</script>