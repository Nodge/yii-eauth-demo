<?php

return CMap::mergeArray(
    // наследуемся от main.php
    require(dirname(__FILE__).'/main.php'),
    array(        
        // autoloading model and component classes
        //'import' => array(),

        // application components
        'components' => array(
			'cache' => array(
				'class' => 'CDummyCache',
			),
        )
    )
);