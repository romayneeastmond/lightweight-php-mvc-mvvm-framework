<p class="page-header">
    <?php echo $this->content;?> <span class="label label-info"><i class="fa fa-arrow-left"></i> Normal Action View Binding</span>
    <br/>
    Hello <?php echo $this->boundModel->firstName ." " .$this->boundModel->lastName ." " .$this->boundModel->emailAddress;?> <span class="label label-info"><i class="fa fa-arrow-left"></i> ViewModel Binding</span>
</p>