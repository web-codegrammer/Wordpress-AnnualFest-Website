<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Fitness_Passion_Separator_Control extends WP_Customize_Control{

    public $type = 'separator';
    
    public function render_content(){
        ?>
        <p><hr></p>
        <?php
    }
}
?>