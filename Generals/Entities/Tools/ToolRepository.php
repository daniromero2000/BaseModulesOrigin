<?php

namespace Modules\Generals\Entities\Tools;

use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class ToolRepository implements ToolRepositoryInterface
{
  public function getSkip($RequestSkip)
  {
    if ($RequestSkip == null) {
      return 0;
    } else {
      return $RequestSkip;
    }
  }

  public function getClientServerData($data)
  {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
      $data['ip'] = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $data['ip'] = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
      $data['ip'] = $_SERVER['REMOTE_ADDR'];
    }
    $data['USER_AGENT']        = $_SERVER['HTTP_USER_AGENT'];
    $data['DEVICE_SESSION_ID'] = session_id() . microtime();
    $data['PAYER_COOKIE']  = session()->getId();

    return $data;
  }
}
