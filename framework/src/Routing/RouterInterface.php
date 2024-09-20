<?php

namespace PhillipMwaniki\Framework\Routing;

use PhillipMwaniki\Framework\Http\Request;

interface RouterInterface
{
    public function dispatch(Request $request);
}
