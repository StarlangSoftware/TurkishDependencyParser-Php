<?php

use olcaytaner\DependencyParser\Universal\UniversalDependencyPosType;
use olcaytaner\DependencyParser\Universal\UniversalDependencyRelation;
use olcaytaner\DependencyParser\Universal\UniversalDependencyType;

class UniversalDependencyRelationTest extends \PHPUnit\Framework\TestCase
{
    public function testDependencyPosType(){
        $this->assertTrue(UniversalDependencyRelation::getDependencyPosType("adj") == UniversalDependencyPosType::ADJ);
        $this->assertTrue(UniversalDependencyRelation::getDependencyPosType("intj") == UniversalDependencyPosType::INTJ);
        $this->assertTrue(UniversalDependencyRelation::getDependencyPosType("Det") == UniversalDependencyPosType::DET);
    }

    public function testDependencyType(){
        $this->assertTrue(UniversalDependencyRelation::getDependencyTag("acl") == UniversalDependencyType::ACL);
        $this->assertTrue(UniversalDependencyRelation::getDependencyTag("iobj") == UniversalDependencyType::IOBJ);
        $this->assertTrue(UniversalDependencyRelation::getDependencyTag("Iobj") == UniversalDependencyType::IOBJ);
        $this->assertTrue(UniversalDependencyRelation::getDependencyTag("fixed") == UniversalDependencyType::FIXED);
    }
}