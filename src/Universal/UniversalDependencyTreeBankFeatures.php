<?php

namespace olcaytaner\DependencyParser\Universal;

class UniversalDependencyTreeBankFeatures
{
    private array $featureList = [];

    static array $universalFeatureTypes = ["PronType", "NumType", "Poss", "Reflex", "Foreign",
        "Abbr", "Typo", "Gender", "Animacy", "NounClass",
        "Number", "Case", "Definite", "Degree", "VerbForm",
        "Mood", "Tense", "Aspect", "Voice", "Evident",
        "Polarity", "Person", "Polite", "Clusivity", "NumForm"];

    static array $universalFeatureValues = [["Art", "Dem", "Emp", "Exc", "Ind", "Int", "Neg", "Prs", "Rcp", "Rel", "Tot"],
        ["Card", "Dist", "Frac", "Mult", "Ord", "Range", "Sets"],
        ["Yes"],
        ["Yes"],
        ["Yes"],

        ["Yes"],
        ["Yes"],
        ["Com", "Fem", "Masc", "Neut"],
        ["Anim", "Hum", "Inan", "Nhum"],
        ["Bantu1", "Bantu2", "Bantu3", "Bantu4", "Bantu5", "Bantu6", "Bantu7", "Bantu8", "Bantu9", "Bantu10", "Bantu11", "Bantu12", "Bantu13", "Bantu14", "Bantu15", "Bantu16", "Bantu17", "Bantu18", "Bantu19", "Bantu20", "Bantu21", "Bantu22", "Bantu23", "Wol1", "Wol2", "Wol3", "Wol4", "Wol5", "Wol6", "Wol7", "Wol8", "Wol9", "Wol10", "Wol11", "Wol12"],

        ["Coll", "Count", "Dual", "Grpa", "Grpl", "Inv", "Pauc", "Plur", "Ptan", "Sing", "Tri"],
        ["Abs", "Acc", "Erg", "Nom", "Abe", "Ben", "Cau", "Cmp", "Cns", "Com", "Dat", "Dis", "Equ", "Gen", "Ins", "Par", "Tem", "Tra", "Voc", "Abl", "Add", "Ade", "All", "Del", "Ela", "Ess", "Ill", "Ine", "Lat", "Loc", "Per", "Sbe", "Sbl", "Spl", "Sub", "Sup", "Ter"],
        ["Com", "Cons", "Def", "Ind", "Spec"],
        ["Abs", "Aug", "Cmp", "Dim", "Equ", "Pos", "Sup"],
        ["Conv", "Fin", "Gdv", "Ger", "Inf", "Part", "Sup", "Vnoun"],

        ["Adm", "Cnd", "Des", "Imp", "Ind", "Int", "Irr", "Jus", "Nec", "Opt", "Pot", "Prp", "Qot", "Sub"],
        ["Fut", "Imp", "Past", "Pqp", "Pres"],
        ["Hab", "Imp", "Iter", "Perf", "Prog", "Prosp"],
        ["Act", "Antip", "Bfoc", "Cau", "Dir", "Inv", "Lfoc", "Mid", "Pass", "Rcp"],
        ["Fh", "Nfh"],

        ["Neg", "Pos"],
        ["0", "1", "2", "3", "4"],
        ["Elev", "Form", "Humb", "Infm"],
        ["Ex", "In"],
        ["Word", "Digit", "Roman"]];

    static array $turkishFeatureValues = [["Art", "Dem", "Ind", "Int", "Neg", "Prs", "Rcp", "Rel", "Tot"],
        ["Card", "Dist", "Ord"],
        [],
        ["Yes"],
        ["Yes"],

        ["Yes"],
        ["Yes"],
        [],
        [],
        [],

        ["Plur", "Sing"],
        ["Acc", "Nom", "Dat", "Equ", "Gen", "Ins", "Abl", "Loc"],
        ["Def", "Ind"],
        ["Cmp", "Sup"],
        ["Conv", "Fin", "Part", "Vnoun"],

        ["Cnd", "Des", "Gen", "Imp", "Ind", "Nec", "Opt", "Pot", "DesPot", "CndPot", "CndGen", "CndGenPot", "GenPot", "PotPot", "GenNecPot", "GenNec", "NecPot", "GenPotPot", "ImpPot"],
        ["Fut", "Past", "Pqp", "Pres", "Aor"],
        ["Imp", "Perf", "Prog", "Prosp", "Hab", "Rapid"],
        ["Cau", "Pass", "Rcp", "Rfl", "CauCau", "CauCauPass", "CauPass", "CauPassRcp", "CauRcp", "PassPass", "PassRfl", "PassRcp"],
        ["Fh", "Nfh"],

        ["Neg", "Pos"],
        ["1", "2", "3"],
        ["Form", "Infm"],
        [],
        []];

    static array $englishFeatureValues = [["Art", "Dem", "Emp", "Ind", "Int", "Neg", "Prs", "Rcp", "Rel", "Tot"],
        ["Card", "Frac", "Mult", "Ord"],
        ["Yes"],
        ["Yes"],
        ["Yes"],

        ["Yes"],
        ["Yes"],
        ["Fem", "Masc", "Neut"],
        [],
        [],

        ["Plur", "Sing"],
        ["Acc", "Nom", "Gen"],
        ["Def", "Ind"],
        ["Cmp", "Pos", "Sup"],
        ["Fin", "Ger", "Inf", "Part"],

        ["Imp", "Ind", "Sub"],
        ["Past", "Pres"],
        [],
        ["Pass"],
        [],

        ["Neg"],
        ["1", "2", "3"],
        [],
        [],
        ["Word", "Digit", "Roman"]];

    /**
     * Constructor of a UniversalDependencyTreeBankFeatures object. Given the language of the word and features of the
     * word as a string, the method splits the features with respect to pipe character. Then for each feature type and
     * value pair, their values and types are inserted into the featureList hash map. The method also check for validity
     * of the feature values for that feature type.
     * @param string $language Language name. Currently, 'en' and 'tr' languages are supported.
     * @param string $features Feature string.
     */
    public function __construct(string $language, string $features){
        if ($features != "_"){
            $list = explode("|", $features);
            foreach ($list as $feature){
                if (str_contains($feature, "=")){
                    $featureName = trim(mb_substr($feature, 0, mb_strpos($feature, "=")));
                    $featureValue = trim(mb_substr($feature, mb_strpos($feature, "=") + 1));
                    if (self::featureValueIndex($language, $featureName, $featureValue) != -1){
                        $this->featureList[$featureName] = $featureName;
                    }
                }
            }
        }
    }

    /**
     * Returns the index of the universal feature type in the universalFeatureTypes array, given the name of the feature
     * type.
     * @param string $featureName Name of the feature type
     * @return int Index of the universal feature type in the universalFeatureTypes array. If the name does not exist, the
     * function returns -1.
     */
    private static function featureIndex(string $featureName): int{
        if (str_contains($featureName, "[")){
            $featureName = substr($featureName, 0, strpos($featureName, "["));
        }
        for ($i = 0; $i < count(self::$universalFeatureTypes); $i++){
            if (self::$universalFeatureTypes[$i] == $featureName){
                return $i;
            }
        }
        return -1;
    }

    /**
     * Returns the index of the given universal dependency pos.
     * @param string $uPos Given universal dependency part of speech tag.
     * @return int The index of the universal dependency pos.
     */
    public static function posIndex(string $uPos): int{
        $index = 0;
        foreach (UniversalDependencyPosType::cases() as $universalDependencyPosType){
            if (((string) $universalDependencyPosType) == $uPos){
                return $index;
            }
            $index++;
        }
        return -1;
    }

    /**
     * Returns the index of the universal dependency type in the universalDependencyTypes array, given the name of the
     * universal dependency type.
     * @param string $universalDependency Universal dependency type
     * @return int Index of the universal dependency type in the universalDependencyTypes array. If the name does not exist,
     * the function returns -1.
     */
    public static function dependencyIndex(string $universalDependency): int{
        $index = 0;
        foreach (UniversalDependencyRelation::$universalDependencyTypes as $universalDependencyType){
            if (((string) $universalDependencyType) == $universalDependency){
                return $index;
            }
            $index++;
        }
        return -1;
    }

    /**
     * Returns the number of distinct values for a feature in a given language
     * @param string $language Language name. Currently, 'en' and 'tr' languages are supported.
     * @param string $featureName Name of the feature type.
     * @return int The number of distinct values for a feature in a given language
     */
    public static function numberOfValues(string $language, string $featureName): int
    {
        $fIndex = self::featureIndex($featureName);
        if ($fIndex != -1){
            switch ($language){
                case "en":
                    return count(self::$englishFeatureValues[$fIndex]);
                case "tr":
                    return count(self::$turkishFeatureValues[$fIndex]);
            }
        }
        return -1;
    }

    /**
     * Returns the index of the given value in the feature value array for the given feature in the given
     * language.
     * @param string $language Language name. Currently, 'en' and 'tr' languages are supported.
     * @param string $featureName Name of the feature.
     * @param string $featureValue Value of the feature.
     * @return int The index of the given feature value in the feature value array for the given feature in the given
     * language.
     */
    public static function featureValueIndex(string $language, string $featureName, string $featureValue): int{
        $fIndex = self::featureIndex($featureName);
        if ($fIndex != -1){
            switch ($language){
                case "en":
                    $searchArray = self::$englishFeatureValues;
                    break;
                case "tr":
                    $searchArray = self::$turkishFeatureValues;
                    break;
                case "u":
                    $searchArray = self::$universalFeatureValues;
                    break;
            }
            $featureValueIndex = -1;
            for ($i = 0; $i < count($searchArray[$fIndex]); $i++){
                if ($featureValue == $searchArray[$fIndex][$i]){
                    $featureValueIndex = $i;
                }
            }
            return $featureValueIndex;
        }
        return -1;
    }

    /**
     * Gets the value of a given feature.
     * @param string $feature Name of the feature
     * @return string Value of the feature
     */
    public function getFeatureValue(string $feature): string{
        return $this->featureList[$feature];
    }

    /**
     * Checks if the given feature exists in the feature list.
     * @param string $feature Name of the feature
     * @return bool True, if the feature list contains the feature, false otherwise.
     */
    public function featureExists(string $feature): bool{
        return array_key_exists($feature, $this->featureList);
    }

    /**
     * Overridden toString method. Returns feature with their values separated with pipe characters.
     * @return string A string of feature values and their names separated with pipe character.
     */
    public function __toString(): string{
        if (count($this->featureList) == 0){
            return "_";
        }
        $result = "";
        foreach ($this->featureList as $feature => $featureValue){
            if ($result == ""){
                $result .= $feature . "=" . $featureValue;
            } else {
                $result .= "|" . $feature . "=" . $featureValue;
            }
        }
        return $result;
    }
}