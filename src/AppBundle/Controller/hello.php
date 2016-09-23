<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class hello extends Controller
{
    private $a;
    private $b;
    public $sum;

    public function __construct($a, $b)
    {
        $this->a = $a;
        $this->b = $b;
    }
    public function add(){
        $this->sum = $this->a + $this->b;
    }
    public function display(){
        return $this->sum;
    }


}