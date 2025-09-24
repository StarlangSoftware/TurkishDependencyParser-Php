<?php

use olcaytaner\DependencyParser\Stanford\StanfordDependencyRelation;
use olcaytaner\DependencyParser\Stanford\StanfordDependencyType;

class StanfordDependencyRelationTest extends \PHPUnit\Framework\TestCase
{
    public function testDependencyType(){
        $this->assertTrue(StanfordDependencyRelation::getDependencyTag("acomp") == StanfordDependencyType::ACOMP);
        $this->assertTrue(StanfordDependencyRelation::getDependencyTag("discourse") == StanfordDependencyType::DISCOURSE);
        $this->assertTrue(StanfordDependencyRelation::getDependencyTag("Iobj") == StanfordDependencyType::IOBJ);
        $this->assertTrue(StanfordDependencyRelation::getDependencyTag("iobj") == StanfordDependencyType::IOBJ);
    }
}