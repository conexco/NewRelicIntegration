<?php
return array(
    'version' => $this->getVersion(),
    'label' => $this->getLabel(),
    'autor' => 'conexco - the e-commerce experts',
    'link' => 'http://www.conexco.com/'
    'source' => $this->getSource(),
    'description' => file_get_contents($this->Path() . 'info.txt'),
);
