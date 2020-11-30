<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['BASE_DIR']= realpath(APPPATH .'../cocoon');

$config['MAIN_URL']= 'http://cocoon.arihantsolutions.info';
$config['MAIN_DIR']= realpath(BASEPATH .'..');

$config['img_path'] = 'C:/xampp/htdocs/cocoon/admin/uploads';

$config['COCOON_BASE_URL']	= $config['MAIN_URL'] .'/cocoon';
$config['COCOON_BASE_DIR']	= $config['BASE_DIR'] . '/cocoon';

$config['ADMIN_BASE_URL']	= $config['MAIN_URL'].'/admin';
$config['ADMIN_BASE_DIR']	= $config['MAIN_DIR'].'/admin';

$config['ADMIN_IMG_URL']	= $config['ADMIN_BASE_URL'].'/uploads';
$config['ADMIN_IMG_DIR']	= realpath(APPPATH . '../admin/uploads');


$config['ADMIN_THUMB_URL']	= $config['ADMIN_IMG_URL'].'/thumbs/';
$config['ADMIN_THUMB_DIR']	= $config['ADMIN_IMG_DIR'].'\thumbs';
