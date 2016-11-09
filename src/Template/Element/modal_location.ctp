<div class="modal fade" id="modal-location" tabindex="-1" role="dialog" aria-labelledby="modal-location">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Baixa de Locação</h4>
            </div>
            <div class="modal-body modal-body-locations">
                <h5 class="text-center"></h5>
                <hr/>
                <label>Quilometragem do veículo</label>
                <div class="row">
                  <form method="get" action="" id="form-location-finished">
                    <div class="col-md-4 col-responsive-span">
                        <input type="hidden" name="location_id" class="location-id-hidden"/>
                        <input type="text" class="form-control km-chegada" name="finish_km"/>
                    </div>
                    <div class="col-md-8 permitido text-center">
                        <table class="table table-hover" style="margin-top:-35px">
                            <thead>
                            <tr>
                                <th class="text-center">Km de saída</th>
                                <th class="text-center">Km Permitida</th>
                                <th class="text-center">Km devolução</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="td1"></td>
                                <td class="td2"></td>
                                <td class="td3"></td>
                            </tr>
                            </tbody>
                        </table>
                        <h5></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="total">
                        <div class="col-md-6">
                            TOTAL
                        </div>
                        <div class="col-md-6 input-group">
                            <span class="input-group-addon" id="basic-addon1">R$</span>
                            <input type="text" class="form-control" name="finish_value" aria-describedby="basic-addon1">
                        </div>
                        <i class="fa fa-edit"></i>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="verify-tank"></h5>
                        <textarea rows="3" placeholder="Verificação de tanque no momento da entrega" name="finish_tank"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-success confirm-location">Confirmar Baixa</button>
            </div>
          </form>
        </div>
    </div>
</div>

<?=
$this->append('css', $this->Html->css([
    'modalLocations'
]));
?>
