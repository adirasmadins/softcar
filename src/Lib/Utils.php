<?php

namespace App\Lib;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

class Utils {

    static function r_acc($string) {
        $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ', 'Ά', 'ά', 'Έ', 'έ', 'Ό', 'ό', 'Ώ', 'ώ', 'Ί', 'ί', 'ϊ', 'ΐ', 'Ύ', 'ύ', 'ϋ', 'ΰ', 'Ή', 'ή');
        $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o', 'Α', 'α', 'Ε', 'ε', 'Ο', 'ο', 'Ω', 'ω', 'Ι', 'ι', 'ι', 'ι', 'Υ', 'υ', 'υ', 'υ', 'Η', 'η');

        return str_replace($a, $b, trim($string));
    }

    function slugify($string) {
        $string = $this->r_acc($string);
        return strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'), array('', '-', ''), $string));
    }

    static function dateToBr($date, $time = false) {
        $date = Time::createFromFormat('Y-m-d', $date)->i18nFormat('dd/MM/YYYY');
        if ($time) {
            $date.=' ' . $time;
        }
        return $date;
    }

    static function brToDate($date, $time = false) {
        $date = Time::createFromFormat('d/m/Y', $date)->i18nFormat('YYYY-MM-dd');
        if ($time) {
            $date.=' ' . $time;
        }
        return $date;
    }

    static function getWeekday($day){
        $days = [
            '1' => 'Domingo',
            '2' => 'Segunda-Feira',
            '3' => 'Terça-Feira',
            '4' => 'Quarta-Feira',
            '5' => 'Quinta-Feira',
            '6' => 'Sexta-Feira',
            '7' => 'Sábado'
        ];

        if(is_numeric($day)){
            return $days[$day];
        }
    }

    static function getMonth($num, $type = 'full') {
        $months = [
            'full' => [
                1 => 'Janeiro',
                2 => 'Fevereiro',
                3 => 'Março',
                4 => 'Abril',
                5 => 'Maio',
                6 => 'Junho',
                7 => 'Julho',
                8 => 'Agosto',
                9 => 'Setembro',
                10 => 'Outubro',
                11 => 'Novembro',
                12 => 'Dezembro'
            ],
            'min' => [
                1 => 'Jan',
                2 => 'Fev',
                3 => 'Mar',
                4 => 'Abr',
                5 => 'Mai',
                6 => 'Jun',
                7 => 'Jul',
                8 => 'Ago',
                9 => 'Set',
                10 => 'Out',
                11 => 'Nov',
                12 => 'Dez'
            ]
        ];

        if (is_numeric($num)) {
            return $months[$type][$num];
        } else {
            return array_search($num, $months[$type]);
        }
    }

    static function getPeriod($type, $num) {
        $periodName = '';
        switch ($type) {
            case 1:
                $periodName = self::getMonth($num);
                break;
            case 2:
                $periodName = $num . 'º Bimestre';
                break;
            case 3:
                $periodName = $num . 'º Trimestre';
                break;
            case 4:
                $periodName = $num . 'º Quadrimestre';
                break;
            case 6:
                $periodName = $num . 'º Semestre';
                break;
        }
        return $periodName;
    }

    static function getPeriodByMonth($type, $month) {
        return $periodNum = ceil($month / $type);
    }

    static function getVideoId($url) {
        $youtubePattern = '/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"\'>]+)/';
        $vimeoPattern = '/(https?:\/\/)?(www.)?(player.)?vimeo.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/';
        $pattern = $youtubePattern;
        $patternIndex = 1;//index padrão youtube
        $type = 'youtube';
        $matches = [];

        //video do vimeo
        if(strpos($url, 'vimeo') !== false) {
            $pattern = $vimeoPattern;
            $patternIndex = 5;//index padrão vimeo
            $type = 'vimeo';
        }

        preg_match($pattern, $url, $matches);

        if(isset($matches[$patternIndex]))
            return ['type'=>$type,'id'=>$matches[$patternIndex]];
        return false;
    }

    static function getEmbedPlayer($id,$type = 'youtube') {
        $urls = [
            'youtube' => "https://www.youtube.com/embed/{$id}?rel=0&showinfo=0&color=white&iv_load_policy=3",
            'vimeo' => "http://player.vimeo.com/video/{$id}?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ffffff",
        ];

        $url = isset($urls[$type]) ? $urls[$type] : $urls['youtube'];

        $player = "<div class='embed-responsive embed-responsive-16by9'><iframe class='video_item' id='{$id}' type='text/html' src='{$url}' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>";
        return $player;
    }

    static function fazerUpload($data, $nome_pasta){
        $file = false;

        if (!empty($data['picture']['name'])) {
            $partes = explode('.', $data['picture']['name']);
            $ext = array_pop($partes);
            $file = 'files/' . $nome_pasta .'/' . md5(date('Ymdhisu')) . '.' . $ext;
            move_uploaded_file($data['picture']['tmp_name'], WWW_ROOT . $file);
        }

        return $file;
    }

    static function fazerUploadClients($data, $nome_pasta, $key){
        $file = false;

        if (!empty($data['name'])) {
            $partes = explode('.', $data['name']);
            $ext = array_pop($partes);
            $file = 'files/' . $nome_pasta .'/' . $key .  md5(date('Ymdhis')) . '.' . $ext;
            move_uploaded_file($data['tmp_name'], WWW_ROOT . $file);
        }

        return $file;
    }

    static function getStatusReal($status){
        $status == 0 ? $status_real = '<span class="label label-danger">Inativo</span>' : '';
        $status == 1 ? $status_real = '<span class="label label-success">Ativo</span>' : '';

        return $status_real;
    }

    static function getVehicle($vehicleId){
        $Vehicle = TableRegistry::get('Vehicles');
        $vehicle = $Vehicle->get($vehicleId);

        return $vehicle->model;
    }

    static function getVehicleId($plate){
        $Vehicle = TableRegistry::get('Vehicles');
        $vehicle = $Vehicle->find()->where(['plate like' => '%' . $plate . '%'])->first();

        return $vehicle['id'];
    }

    static function getServiceReal($inicial){
        $services = [
            't' => 'Troca de Óleo',
            'r' => 'Revisão',
            'o' => 'Outro'
        ];
        if($inicial){
            return $services[$inicial];
        }
    }

    static function getStateName($id){
        $States = TableRegistry::get('States');

        $state = $States->find()->where(['id' => $id])->first();

        return $state['name'];
    }

    static function getStatusTicket($status){
        $status == 0 ? $status_real = '<span class="label label-warning">Não</span>' : '';
        $status == 1 ? $status_real = '<span class="label label-success">Sim</span>' : '';

        return $status_real;
    }

    static function getClientName($id){
        $Clients = TableRegistry::get('Clients');

        $result = $Clients->find()
            ->hydrate(false)
            ->select([
                'name',
                'cpf_cnpj'
            ])
            ->where([
                'id' => $id
            ])
            ->first();

        return $result['name'] . ' - ' . $result['cpf_cnpj'];
    }

    static function getClientOnlyName($id){
        $Clients = TableRegistry::get('Clients');

        $result = $Clients->find()
            ->hydrate(false)
            ->select([
                'name'
            ])
            ->where([
                'id' => $id
            ])
            ->first();

        return $result['name'];
    }

    static function getAllInformationsClients($id){
        $Clients = TableRegistry::get('Clients');

        $result = $Clients->find()
            ->hydrate(false)
            ->where([
                'id' => $id
            ])
            ->first();

        return $result;
    }

    static function getAllInformationsVehicles($id, $what){
        $Vehicles = TableRegistry::get('Vehicles');

        $result = false;

        if($what == 'picture'){
          $result = $Vehicles->find()
          ->select([
            'picture' => 'picture'
          ])
          ->hydrate(false)
          ->where([
              'id' => $id
          ])
          ->limit(1)
          ->first();

          return $result['picture'];

        } else if ($what == 'model and plate'){
          $result = $Vehicles->find()
          ->select([
            'model' => 'model',
            'plate' => 'plate'
          ])
          ->hydrate(false)
          ->where([
              'id' => $id
          ])
          ->limit(1)
          ->first();

          return $result['model'] . ' (' . $result['plate'] . ')';
        } else {
          $result = $Vehicles->find()
          ->hydrate(false)
          ->where([
              'id' => $id
          ])
          ->limit(1)
          ->first();

          return $result;
        }
    }

    static function getStatusReserves($status){
        return $status == 0 ? '<span class="label label-success">Sim</span>' : '<span class="label label-danger">Não</span>';
    }

    static function getStatusLocations($status){
        return $status == 0 ? '<span class="label label-warning">Não</span>' : '<span class="label label-success">Sim</span>';
    }

    static function getDependInformationVehicle($entity, $value){
      $Entity = TableRegistry::get($entity);

      $result = $Entity->find()
                ->hydrate(false)
                ->select('name')
                ->where([
                  'id' => $value
                ])
                ->limit(1)
                ->first();
      return $result['name'];
    }
}
