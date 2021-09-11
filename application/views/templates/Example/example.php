<div class="row">
    <div class="col-md-9 col-sm-12 col-xs-12">
        <h2><?php echo $this->title;?></h2>

        <?php $this->renderPartialView("Example", $this->partial);?>
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12">
        <?php $this->renderPartialView("Partial", "_examples");?>
    </div>
</div>