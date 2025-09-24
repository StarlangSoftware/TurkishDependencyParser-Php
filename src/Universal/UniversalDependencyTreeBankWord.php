<?php

namespace olcaytaner\DependencyParser\Universal;

use olcaytaner\Dictionary\Dictionary\Word;

class UniversalDependencyTreeBankWord extends Word
{
    private int $id;

    private string $lemma;
    private ?UniversalDependencyPosType $upos;
    private string $xpos;
    private ?UniversalDependencyTreeBankFeatures $features;
    private UniversalDependencyRelation $relation;
    private string $deps;
    private string $misc;

    /**
     * Default constructor for the universal dependency word. Sets the attributes to default values.
     */
    private function constructor1(){
        $this->id = 0;
        $this->lemma = "";
        $this->upos = null;
        $this->xpos = "";
        $this->features = null;
        $this->deps = "";
        $this->misc = "";
        $this->relation = new UniversalDependencyRelation(-1, "DEP");
    }

    /**
     * Constructor of the universal dependency word. Sets the attributes.
     * @param int $id Id of the word
     * @param string $lemma Lemma of the word
     * @param UniversalDependencyPosType $upos Universal part of speech tag.
     * @param string $xpos Extra part of speech tag
     * @param UniversalDependencyTreeBankFeatures $features Feature list of the word
     * @param UniversalDependencyRelation $relation Universal dependency relation of the word
     * @param string $deps External dependencies for the word
     * @param string $misc Miscellaneous information for the word.
     */
    private function constructor2(int $id, string $lemma, UniversalDependencyPosType $upos, string $xpos, UniversalDependencyTreeBankFeatures $features, UniversalDependencyRelation $relation, string $deps, string $misc){
        $this->id = $id;
        $this->lemma = $lemma;
        $this->upos = $upos;
        $this->xpos = $xpos;
        $this->deps = $deps;
        $this->features = $features;
        $this->relation = $relation;
        $this->misc = $misc;
    }

    public function __construct(?int $id, ?string $name, ?string $lemma, ?UniversalDependencyPosType $upos, ?string $xpos, ?UniversalDependencyTreeBankFeatures $features, ?UniversalDependencyRelation $relation, ?string $deps, ?string $misc)
    {
        if ($id === null) {
            parent::__construct("root");
            $this->constructor1();
        } else {
            parent::__construct($name);
            $this->constructor2($id, $lemma, $upos, $xpos, $features, $relation, $deps, $misc);
        }
    }

    /**
     * Accessor for the id attribute.
     * @return int Id attribute
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Accessor for the lemma attribute
     * @return string Lemma attribute
     */
    public function getLemma(): string
    {
        return $this->lemma;
    }

    /**
     * Accessor for the upos attribute
     * @return UniversalDependencyPosType|null Upos attribute
     */
    public function getUpos(): ?UniversalDependencyPosType
    {
        return $this->upos;
    }

    /**
     * Accessor for the xpos attribute
     * @return string Xpos attribute
     */
    public function getXpos(): string
    {
        return $this->xpos;
    }

    /**
     * Accessor for the features attribute
     * @return UniversalDependencyTreeBankFeatures|null Features attribute
     */
    public function getFeatures(): ?UniversalDependencyTreeBankFeatures
    {
        return $this->features;
    }

    /**
     * Accessor for the relation attribute.
     * @return UniversalDependencyRelation Relation attribute
     */
    public function getRelation(): UniversalDependencyRelation
    {
        return $this->relation;
    }

    /**
     * Accessor for the deps attribute
     * @return string Xpos attribute
     */
    public function getDeps(): string
    {
        return $this->deps;
    }

    /**
     * Accessor for the misc attribute
     * @return string Misc attribute
     */
    public function getMisc(): string
    {
        return $this->misc;
    }

    /**
     * Gets the value of a given feature.
     * @param string $featureName Name of the feature
     * @return string Value of the feature
     */
    public function getFeatureValue(string $featureName): string{
        return $this->features->getFeatureValue($featureName);
    }

    /**
     * Checks if the given feature exists.
     * @param string $featureName Name of the feature
     * @return bool True if the given feature exists, false otherwise.
     */
    public function featureExists(string $featureName): bool{
        return $this->features->featureExists($featureName);
    }

    /**
     * Mutator for the relation attribute
     * @param UniversalDependencyRelation $relation New relation attribute
     */
    public function setRelation(UniversalDependencyRelation $relation): void
    {
        $this->relation = $relation;
    }

    public function toString(): string
    {
        return $this->id . "\t" . $this->lemma . "\t" . $this->upos . "\t" . $this->xpos . "\t" . $this->features->__toString() . "\t" . $this->relation->to() . "\t" . $this->relation->__toString() . "\t" . $this->deps . "\t" . $this->misc . "\n";
    }

}