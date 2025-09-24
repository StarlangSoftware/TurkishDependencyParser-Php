<?php

use olcaytaner\DependencyParser\Universal\UniversalDependencyTreeBankCorpus;
use PHPUnit\Framework\TestCase;

class UniversalDependencyTreeBankCorpusTest extends TestCase
{
    public function testDependencyCorpus1(){
        $corpus = new UniversalDependencyTreeBankCorpus("../tr_gb-ud-test.conllu");
        $this->assertEquals(2880, $corpus->sentenceCount());
    }

    public function testDependencyCorpus2(){
        $corpus = new UniversalDependencyTreeBankCorpus("../tr_imst2-ud-dev.conllu");
        $this->assertEquals(1100, $corpus->sentenceCount());
    }

    public function testDependencyCorpus3(){
        $corpus = new UniversalDependencyTreeBankCorpus("../tr_imst2-ud-test.conllu");
        $this->assertEquals(1100, $corpus->sentenceCount());
    }

    public function testDependencyCorpus4(){
        $corpus = new UniversalDependencyTreeBankCorpus("../tr_imst2-ud-train.conllu");
        $this->assertEquals(3435, $corpus->sentenceCount());
    }

    public function testDependencyCorpus5(){
        $corpus = new UniversalDependencyTreeBankCorpus("../tr_pud-ud-test.conllu");
        $this->assertEquals(1000, $corpus->sentenceCount());
    }

    public function testDependencyCorpus6(){
        $corpus = new UniversalDependencyTreeBankCorpus("../tr_boun-ud-dev.conllu");
        $this->assertEquals(979, $corpus->sentenceCount());
    }

    public function testDependencyCorpus7(){
        $corpus = new UniversalDependencyTreeBankCorpus("../tr_boun-ud-test.conllu");
        $this->assertEquals(979, $corpus->sentenceCount());
    }

    public function testDependencyCorpus8(){
        $corpus = new UniversalDependencyTreeBankCorpus("../tr_boun-ud-train.conllu");
        $this->assertEquals(7803, $corpus->sentenceCount());
    }

    public function testDependencyCorpus9(){
        $corpus = new UniversalDependencyTreeBankCorpus("../en_atis-ud-dev.conllu");
        $this->assertEquals(572, $corpus->sentenceCount());
    }

    public function testDependencyCorpus10(){
        $corpus = new UniversalDependencyTreeBankCorpus("../en_atis-ud-test.conllu");
        $this->assertEquals(586, $corpus->sentenceCount());
    }

    public function testDependencyCorpus11(){
        $corpus = new UniversalDependencyTreeBankCorpus("../en_atis-ud-train.conllu");
        $this->assertEquals(4274, $corpus->sentenceCount());
    }

    public function testDependencyCorpus12(){
        $corpus = new UniversalDependencyTreeBankCorpus("../tr_atis-ud-dev.conllu");
        $this->assertEquals(572, $corpus->sentenceCount());
    }

    public function testDependencyCorpus13(){
        $corpus = new UniversalDependencyTreeBankCorpus("../tr_atis-ud-test.conllu");
        $this->assertEquals(586, $corpus->sentenceCount());
    }

    public function testDependencyCorpus14(){
        $corpus = new UniversalDependencyTreeBankCorpus("../tr_atis-ud-train.conllu");
        $this->assertEquals(4274, $corpus->sentenceCount());
    }

    public function testDependencyCorpus15(){
        $corpus = new UniversalDependencyTreeBankCorpus("../tr_framenet-ud-dev.conllu");
        $this->assertEquals(205, $corpus->sentenceCount());
    }

    public function testDependencyCorpus16(){
        $corpus = new UniversalDependencyTreeBankCorpus("../tr_framenet-ud-test.conllu");
        $this->assertEquals(205, $corpus->sentenceCount());
    }

    public function testDependencyCorpus17(){
        $corpus = new UniversalDependencyTreeBankCorpus("../tr_framenet-ud-train.conllu");
        $this->assertEquals(2288, $corpus->sentenceCount());
    }

    public function testDependencyCorpus18(){
        $corpus = new UniversalDependencyTreeBankCorpus("../tr_kenet-ud-dev.conllu");
        $this->assertEquals(1646, $corpus->sentenceCount());
    }

    public function testDependencyCorpus19(){
        $corpus = new UniversalDependencyTreeBankCorpus("../tr_kenet-ud-test.conllu");
        $this->assertEquals(1643, $corpus->sentenceCount());
    }

    public function testDependencyCorpus20(){
        $corpus = new UniversalDependencyTreeBankCorpus("../tr_kenet-ud-train.conllu");
        $this->assertEquals(15398, $corpus->sentenceCount());
    }

    public function testDependencyCorpus21(){
        $corpus = new UniversalDependencyTreeBankCorpus("../tr_penn-ud-dev.conllu");
        $this->assertEquals(622, $corpus->sentenceCount());
    }

    public function testDependencyCorpus22(){
        $corpus = new UniversalDependencyTreeBankCorpus("../tr_penn-ud-test.conllu");
        $this->assertEquals(924, $corpus->sentenceCount());
    }

    public function testDependencyCorpus23(){
        $corpus = new UniversalDependencyTreeBankCorpus("../tr_penn-ud-train.conllu");
        $this->assertEquals(14850, $corpus->sentenceCount());
    }

    public function testDependencyCorpus24(){
        $corpus = new UniversalDependencyTreeBankCorpus("../tr_tourism-ud-dev.conllu");
        $this->assertEquals(2166, $corpus->sentenceCount());
    }

    public function testDependencyCorpus25(){
        $corpus = new UniversalDependencyTreeBankCorpus("../tr_tourism-ud-test.conllu");
        $this->assertEquals(2191, $corpus->sentenceCount());
    }

    public function testDependencyCorpus26(){
        $corpus = new UniversalDependencyTreeBankCorpus("../tr_tourism-ud-train.conllu");
        $this->assertEquals(15473, $corpus->sentenceCount());
    }

    public function testDependencyCorpus27(){
        $corpus = new UniversalDependencyTreeBankCorpus("../en_ewt-ud-dev.conllu");
        $this->assertEquals(2000, $corpus->sentenceCount());
    }

    public function testDependencyCorpus28(){
        $corpus = new UniversalDependencyTreeBankCorpus("../en_ewt-ud-test.conllu");
        $this->assertEquals(2076, $corpus->sentenceCount());
    }

}