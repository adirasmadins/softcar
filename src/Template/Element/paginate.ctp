<?php if ($this->Paginator->counter() != '1 of 1'):  ?>
    <div class="col-md-12">
        <div class="paginator pull-left">
            <ul class="pagination">
                <?= $this->Paginator->prev(__('<i class="fa fa-angle-double-left"></i>'), ['escape' => false]) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('<i class="fa fa-angle-double-right"></i>'), ['escape' => false]) ?>
            </ul>
        </div>
    </div>
<?php endif; ?>