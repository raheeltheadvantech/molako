<div class="container">
<div class="row">
    <div class="container content-pages">
        <div class="col-md-12 pages-text">
                <h1 class="text-center"><?php echo isset($result->title) ? $result->title : '';?></h1>
            <p>
                <?php echo $result->content;?>
            </p>
            </div>
        </div>
    </div>
</div>
