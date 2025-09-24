<?php

use olcaytaner\DependencyParser\Turkish\TurkishDependencyRelation;
use olcaytaner\DependencyParser\Turkish\TurkishDependencyType;

class TurkishDependencyRelationTest extends \PHPUnit\Framework\TestCase
{
    public function testDependencyType(){
        $this->assertTrue(TurkishDependencyRelation::getDependencyTag("subject") == TurkishDependencyType::SUBJECT);
        $this->assertTrue(TurkishDependencyRelation::getDependencyTag("vocative") == TurkishDependencyType::VOCATIVE);
        $this->assertTrue(TurkishDependencyRelation::getDependencyTag("Relativizer") == TurkishDependencyType::RELATIVIZER);
    }
}