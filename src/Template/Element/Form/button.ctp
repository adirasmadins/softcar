<?php
if(isset($options['icon'])):
    $icon = "<i class='fa fa-". $options['icon'] ."'>&nbsp;</i>";

    echo $this->Form->button($icon . $options['text'],[
        'label' => false,
        'type' => $options['type'],
        'action' => $options['action'],
        'class' => $options['class'],
        [
            'escape' => false
        ]
    ]);
endif;

?>