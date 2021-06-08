<?php


class NotFoundController extends BaseController
{

    public function action(){
        http_response_code(404);
    }

}