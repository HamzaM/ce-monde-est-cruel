<?php

namespace Hackathon\PlayerIA;

use Hackathon\Game\Result;

/**
 * Class ToydariaPlayers
 * @package Hackathon\PlayerIA
 * @author Hamza MEBAREK
 * J'ai vu qu'une stratégie lorsque l'ennemi utilise 2fois 
 * ou plus le meme move de suite, il tend a contrer avec un move 
 * pour battre notre dernier, du coup j'anticipe et j'attaque avec
 * l'opposé de ce move
 * 
 * Ma 2eme stratégie qui passe si cette derniere ne passe pas consiste
 * a analyser le move le plus utilisé par l'ennemi et utiliser l'opposé
 */
class ToydariaPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    public function getChoice()
    {
        //gerer round 0
        $round = $this->result->getNbRound();
        if ($round == 0) {
            return parent::paperChoice();
        }

        $stats = $this->result->getStatsFor($this->opponentSide);
        $scissors = $stats['scissors'];
        $paper = $stats['paper'];
        $rock = $stats['rock'];

        $oppo_choices = $this->result->getChoicesFor($this->opponentSide);
        $my_choices = $this->result->getChoicesFor($this->mySide);

        $oppo_len = count($oppo_choices);
        $my_len = count($my_choices);


        if ($oppo_len > 1 && $my_len > 1) {
            $last_play = $oppo_choices[$oppo_len - 1];
            $blast_play = $oppo_choices[$oppo_len - 2];
            $my_last_play = $my_choices[$my_len - 1];

            if ($last_play == $blast_play) {
                if ($last_play == 'rock') {
                    return parent::paperChoice();
                }
                else if ($last_play == 'paper') {
                    return parent::rockChoice();
                }
                return parent::scissorsChoice();
            }
        }

        if (max($paper, $rock, $scissors) == $paper) {
            return parent::scissorsChoice();
        }

        else if(max($paper, $rock, $scissors) == $rock) {
            return parent::paperChoice();

        }
        return parent::rockChoice();
    }
};
