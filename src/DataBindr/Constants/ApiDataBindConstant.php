<?php

namespace Alexandreo\DataBindr\Constants;


class ApiDataBindConstant
{

    use \Alexandreo\DataBindr\ConstantTrait;

    CONST URI = 'api.databindr.com/';

    CONST HTTP_400 = 'Error-Malformed-Request';

    CONST HTTP_401 = 'Error-Unauthorized';

    CONST HTTP_402 = 'Error-Payment-Required';

    CONST HTTP_404 = 'Error-Connect';

    CONST HTTP_429 = 'Error-Too-Many-Requests';

    CONST HTTP_753 = 'Error-Syntax-Error';


}