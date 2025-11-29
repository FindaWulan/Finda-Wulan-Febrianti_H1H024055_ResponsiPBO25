<?php
class PokeCare extends Pokemon {
    private $trainingHistory = [];

    public function __construct($level = 5, $currentHp = 95) {
        parent::__construct(
            'Vulpix',
            'Fire',
            $level,
            95,
            ['Ember' => 'Serangan api yang membakar musuh', 'Quick Attack' => 'Serangan cepat dengan goresan cengkraman']
        );
        $this->currentHp = $currentHp;
    }

    public function train($trainingType, $intensity) {
        $oldLevel = $this->level;
        $oldHp = $this->currentHp;

        $levelBonus = 0;
        $hpBonus = 0;

        switch ($trainingType) {
            case 'Attack':
                $levelBonus = ceil($intensity / 20);
                $hpBonus = ceil($intensity / 30);
                break;
            case 'Defense':
                $levelBonus = ceil($intensity / 25);
                $hpBonus = ceil($intensity / 15);
                break;
            case 'Speed':
                $levelBonus = ceil($intensity / 30);
                $hpBonus = ceil($intensity / 40);
                break;
            default:
                $levelBonus = ceil($intensity / 25);
                $hpBonus = ceil($intensity / 25);
        }

        $this->level += $levelBonus;
        $this->currentHp = min($this->currentHp + $hpBonus, $this->maxHp);

        $session = [
            'type' => $trainingType,
            'intensity' => $intensity,
            'levelBefore' => $oldLevel,
            'levelAfter' => $this->level,
            'hpBefore' => $oldHp,
            'hpAfter' => $this->currentHp,
            'timestamp' => date('Y-m-d H:i:s')
        ];

        $this->trainingHistory[] = $session;
        return $session;
    }

    public function specialMove() {
        $moves = $this->specialMoves;
        $randomMove = array_rand($moves);
        return [
            'name' => $randomMove,
            'description' => $moves[$randomMove]
        ];
    }

    public function getTrainingHistory() {
        return $this->trainingHistory;
    }

    public function setTrainingHistory($history) {
        $this->trainingHistory = $history;
    }
    
    public function updateStats($level, $currentHp) {
        $this->level = $level;
        $this->currentHp = min($currentHp, $this->maxHp);
    }
}
?>
