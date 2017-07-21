<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Table tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['fibaListEmpfehlungsgeber'] = '{title_legend},name,headline,type;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_module']['palettes']['fibaEmpfehlungsgeberDashboard'] = '{title_legend},name,headline,type;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_module']['palettes']['registration'] = str_replace('{config_legend}','{config_legend},isEmpfehlungsgeberRegistrationForm', $GLOBALS['TL_DCA']['tl_module']['palettes']['registration'] );



// Fields
$GLOBALS['TL_DCA']['tl_module']['fields']['isEmpfehlungsgeberRegistrationForm'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['isEmpfehlungsgeberRegistrationForm'],
    'exclude'                 => true,
    'filter'                  => true,
    'inputType'               => 'checkbox',
    'eval'                    => array(),
    'sql'                     => "char(1) NOT NULL default ''"
);