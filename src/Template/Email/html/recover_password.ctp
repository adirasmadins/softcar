<meta charset="UTF-8">
<style>
    @import 'https://fonts.googleapis.com/css?family=Source+Sans+Pro';
</style>

<center>
    <div class="header">
        <div class="header-child">
            <h2>SoftCar</h2>
        </div>
    </div>
    <div class="div-frase">
        <h3>Olá, <b><?= $data['name'] ?></b></h3>
        <p>Você solicitou recuperação de senha?</p>
        <a href="http://<?= $_SERVER['HTTP_HOST'] . $this->request->webroot . 'users/change-password?token=' . $token ?>" class="button">Recuperar Senha</a>

        <div style="height: 135px"></div>
        <small>
            Caso o botão não funcione, clique no link abaixo:
        </small>
        <br/>

        <small>
            <a href="http://<?= $_SERVER['HTTP_HOST'] . $this->request->webroot . 'users/change-password?token=' . $token ?>"><?= $_SERVER['HTTP_HOST'] . $this->request->webroot . 'home/change-password?token=' . $token ?>
            </a>
        </small>
    </div>
</center>

<style>
    .header{
        background-color: #005a87 !important;
        width: 550px;
        height:65px;
    }
    .header-child{
        width:35%;
        height: 94%;
        background-color:white;
        float:left;
        border: 2px solid #005a87 !important;
    }
    .header-child > h2 {
        margin-top: 17px;
        font-family: 'Source Sans Pro', sans-serif;
        color: #005a87 !important;
    }
    .div-frase{
        background-color: white;
        width: 520px;
        height: 300px;
        word-wrap: break-word;
        font-family: 'Source Sans Pro', sans-serif;
        padding: 15px;
        border-bottom: 5px solid #005a87 !important;
        text-align: center;
    }
    .div-frase > a {
        text-decoration: none !important;
        color:white !important;
        background: #005a87 !important;
        padding: 10px !important;
        width: 100px !important;
        margin-bottom: 140px !important;
        text-align: center !important;
    }
</style>