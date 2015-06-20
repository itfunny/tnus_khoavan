<link href="<?= AppObject::getBaseFile('app/video/css/video.css') ?>"   rel="stylesheet" type="text/css">
<div class="content">
    <div class="col_1">
        <h2 class="page_title">VIDEO</h2>
        <div class="news_content">
            <h2 class="news_title"><?= $this->video['title'] ?></h2>
            <p class="views">Lượt xem: <?= $this->video['views'] ?></p>
            <p class="news_intro"><?= strip_tags($this->video['introtext']) ?></p>
            <div class="news_details">
                <iframe width="630" height="415" src="https://www.youtube.com/embed/<?= $this->video["code"] ?>" frameborder="0" allowfullscreen></iframe>
            </div>
            <p class="author"><?= $this->video['author'] ?></p>
        </div>
        <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>
        <div class="fb-comments" data-href="http://developers.facebook.com/docs/plugins/comments/" data-numposts="5" data-colorscheme="light"></div>
        <div class="clearfix"></div>
        <div class="news_other">
            <h2 class="title">Video liên quan</h2>
            <?php
            foreach ($this->most_view_video as $video) {
                ?>
                <div class="items">
                    <a href="?app=video&view=chitiet&id=<?= $video['id'] ?>">
                        <img class="video_thumb" src="http://img.youtube.com/vi/<?= $video['code'] ?>/0.jpg" width="100" />
                        <p class="news_title"><?= $video["title"] ?></p>
                        <p class="views">Lượt xem: <?= $video['views'] ?></p>
                    </a>
                </div>
                <?php
            }
            ?>
        </div>
    </div> 
    <!-- /.col_1-->
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
    </div>
    <!-- /.col_2-->
</div>
<!--  /.content -->
<!--facebook-->
<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1&appId=1431768223799282";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>