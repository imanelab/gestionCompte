<?php

namespace CUserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CUserBundle extends Bundle
{
	 public function getParent()

  {
    return 'FOSUserBundle';
  }
}
