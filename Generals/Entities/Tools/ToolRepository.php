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
}
