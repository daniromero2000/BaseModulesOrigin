<?php

namespace Modules\Generals\Entities\Tools;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
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

  public function getPaginate($paginate, $skip)
  {
    $count = ceil($paginate  / 30);
    $pageList = ($skip + 1) / 5;
    if (is_int($pageList) || $pageList > 1) {
      $page = $skip - 5;
      $max  = $skip + 6 > $count ? intval($skip + ($count - $skip)) : $skip + 6;
    } else {
      $page = 0;
      $max  = $skip + 5 > $count ? intval($skip + ($count - $skip)) : $skip + 5;
    }

    return [
      'paginate'  => $count,
      'position'  => $page,
      'page'      => $pageList,
      'limit'     => $max
    ];
  }

  public function getClientServerData1()
  {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
      $data['ip'] = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $data['ip'] = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
      $data['ip'] = $_SERVER['REMOTE_ADDR'];
    }

    return $data;
  }

  public function getIpCountry()
  {
    // $data = $this->getClientServerData1();

    // dd($data);

    // $xml = simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=" . getRealIpAddr());

    // return $xml;
  }

  public function deleteThumbFromServer(string $src): bool
  {
    if (File::exists(storage_path('app/public/' . $src))) {
      return  unlink(storage_path('app/public/' . $src));
    }

    return false;
  }
}
