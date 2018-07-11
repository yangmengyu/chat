<?php

return array (
  'autoload' => false,
  'hooks' => 
  array (
    'leesignhook' => 
    array (
      0 => 'leesign',
    ),
    'upload_after' => 
    array (
      0 => 'thumb',
    ),
  ),
  'route' => 
  array (
    '/leesign$' => 'leesign/index/index',
  ),
);