<?php

namespace olcaytaner\DependencyParser\Turkish;

use olcaytaner\Corpus\Corpus;
use olcaytaner\XmlParser\XmlDocument;

class TurkishDependencyTreeBankCorpus extends Corpus
{
    /**
     * Another constructor for {@link TurkishDependencyTreeBankCorpus}. The method gets the corpus as a xml file, and
     * reads sentences one by one. For each sentence, the function constructs a TurkishDependencyTreeBankSentence.
     * @param string $fileName Input file name to read the TurkishDependencyTreeBankCorpus.
     */
    public function __construct(string $fileName)
    {
        parent::__construct();
        $doc = new XmlDocument($fileName);
        $doc->parse();
        $rootNode = $doc->getFirstChild();
        $sentenceNode = $rootNode->getFirstChild();
        while ($sentenceNode !== null) {
            $sentence = new TurkishDependencyTreeBankSentence($sentenceNode);
            $this->addSentence($sentence);
            $sentenceNode = $sentenceNode->getNextSibling();
        }
    }
}