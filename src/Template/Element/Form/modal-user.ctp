<div class="modal fade" id="modalUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center ubuntu">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-gear"></i> Meu Cadastro</h4>
            </div>
            <?= $this->Form->create(null,['id' => 'formUserModal']) ?>
            <div class="modal-body" style="display:none">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <?= $this->Form->input('first_name',['label' => 'Nome','placeholder' => 'Nome','class' => 'form-control']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->input('last_name',['label' => 'Sobrenome','placeholder' => 'Sobrenome','class' => 'form-control']) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <?= $this->Form->input('email',['label' => 'Email','placeholder' => 'Email','class' => 'form-control','disabled' => 'disabled']) ?>
                    </div>
                    <div class="col-md-6 form-group">
                        <?= $this->Form->input('password',['label' => 'Senha','placeholder' => 'Senha','class' => 'form-control']) ?>
                    </div>
                </div>
            </div>
            <?= $this->Form->end() ?>
            <div class="modal-footer text-center">
                <a class="btn btn-success btn-xs overlay pull-left" style="display:none" disabled="disabled"></a>
                <button class="btn btn-warning btn-lg btn-flat voltar-modal" data-dismiss="modal"><i class="fa fa-undo"></i> Voltar</button>
                <button type="submit" class="btn btn-success btn-lg btn-flat salvar-cadastro"><i class="fa fa-check"></i> Salvar</button>
            </div>
        </div>
    </div>
</div>
