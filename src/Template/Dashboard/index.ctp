<?= $this->element('reserves_dash'); ?>
<?= $this->element('locations_dash'); ?>
<?= $this->element('modal_location'); ?>

<?=
$this->append('css', $this->Html->css([
    'indexDashboard'
]));
$this->append('script', $this->Html->script([
    'indexDashboard'
]));
?>

