<?php
abstract class Pokemon {
    protected $name;
    protected $type;
    protected $level;
    protected $maxHp;
    protected $currentHp;
    protected $specialMoves;

    public function __construct($name, $type, $level, $maxHp, $specialMoves = []) {
        $this->name = $name;
        $this->type = $type;
        $this->level = $level;
        $this->maxHp = $maxHp;
        $this->currentHp = $maxHp;
        $this->specialMoves = $specialMoves;
    }

    public function getName() {
        return $this->name;
    }

    public function getType() {
        return $this->type;
    }

    public function getLevel() {
        return $this->level;
    }

    public function getMaxHp() {
        return $this->maxHp;
    }

    public function getCurrentHp() {
        return $this->currentHp;
    }

    public function getSpecialMoves() {
        return $this->specialMoves;
    }

    public function setCurrentHp($hp) {
        $this->currentHp = max(0, min($hp, $this->maxHp));
    }

    public function setLevel($level) {
        $this->level = $level;
    }
    
    public function setMaxHp($maxHp) {
        $this->maxHp = $maxHp;
    }

    abstract public function train($trainingType, $intensity);
    abstract public function specialMove();
}
?>
